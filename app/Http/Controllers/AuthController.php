<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Notifications\UserStatusNotification;


class AuthController extends Controller
{
    /**
     * Show the user login form or redirect if already authenticated.
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $this->redirectUserBasedOnType($user);
        }

        return view('auth.login');
    }

    /**
     * Show the admin login form or redirect if already authenticated.
     *
     * @return View|RedirectResponse
     */
    public function showAdminLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $this->redirectUserBasedOnType($user);
        }

        return view('auth.admin.login');
    }

    /**
     * Show registration form or redirect if already authenticated.
     *
     * @return View|RedirectResponse
     */
    public function registration(): View|RedirectResponse
    {
        return view('auth.registration');
    }

    /**
     * Handle user login request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'login_identifier' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $this->getCredentials($request);
    
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();

            ActivityLog::create([
                'user_id' => $user->id,
                'activity_type' => 'login',
                'description' => 'logged in successfully.',
            ]);

    
            // Check if the user is banned
            if ($user->banned_until && now()->lessThan($user->banned_until)) {
                Auth::logout(); // Logout the user immediately
                $banEndDate = $user->banned_until->format('Y-m-d H:i:s');
                return redirect("login")->withErrors("Your account is banned until {$banEndDate}");

                // return redirect("login")->withErrors("Your account is banned until {$banEndDate} for the following reason: \n{$user->ban_reason}");
            }
    
            if ($user->usertype !== 'user') {
                Auth::logout(); // Logout if the user is an admin or subadmin
                return redirect("login")->withErrors('You are not authorized to access this area.');
            }
    
            return redirect()->intended('posts')->with('success', 'You have successfully logged in');
        }
    
        return redirect("login")->withErrors('Oops! You have entered invalid credentials');
    }
    

    /**
     * Handle admin login request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function postAdminLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->usertype === 'admin') {
                return redirect()->intended('admin/dashboards');
                // ->withSuccess('You have successfully logged in as admin');
            } elseif ($user->usertype === 'subadmin') {
                return redirect()->intended('subadmin/subdashboards');
                // ->withSuccess('You have successfully logged in as sub-admin');
            }

            Auth::logout();
            return redirect()->route('admin.login')->withErrors('You do not have access to this section');
        }

        return redirect()->route('admin.login')->withErrors('Oops! You have entered invalid credentials');
    }

    /**
     * Handle user registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function postRegistration(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'student_id' => 'required|unique:users',
            'username' => 'required|unique:users',
            'course' => 'required|string',
            'status' => 'required|in:current_student,alumni',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'barangay' => 'nullable|string',
            'bday' => 'required|date',
        ]);
    
        // Get all the input data
        $data = $request->all();
    
        // Set the account status to pending
        $data['account_status'] = 'pending';
    
        // Create the user
        $user = $this->create($data);
    
        // Log the registration activity
        ActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => 'registration',
            'description' => 'Registration submitted.',
        ]);
    
        // Optionally send a notification to admins
        // Notification::route('mail', 'admin@example.com')->notify(new NewRegistration($user));
    
        // Redirect with success message
        return redirect("login")->with('success', 'Registration submitted. You will be notified once approved.');
    }
    


    /**
     * Show the posts dashboard if authenticated.
     *
     * @return View|RedirectResponse
     */
    public function posts(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $this->redirectUserBasedOnType($user);
        }

        return redirect("login")->withSuccess('Oops! You do not have access');
    }

    /**
     * Create a new user instance.
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data): User
    {
        return User::create([
            'student_id' => $data['student_id'],
            'username' => $data['username'],
            'course' => $data['course'],
            'status' => $data['status'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'province' => $data['province'] ?? null,
            'city' => $data['city'] ?? null,
            'barangay' => $data['barangay'] ?? null,
            'bday' => $data['bday'],
        ]);
    }

    /**
     * Handle logout request.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $user = Auth::user();
        Session::flush();
        Auth::logout();

        $redirectRoute = 'login'; // Default route for regular users
        
        if ($user) {

            ActivityLog::create([
                'user_id' => $user->id,
                'activity_type' => 'logout',
                'description' => 'logged out.',
            ]);
            
            if ($user->usertype === 'admin') {
                $redirectRoute = 'admin.login'; // Route for admin login
            } elseif ($user->usertype === 'subadmin') {
                $redirectRoute = 'admin.login'; // Route for subadmin login
            }
        }

        return redirect()->route($redirectRoute);
    }

    /**
     * Redirect the user based on their type.
     *
     * @param User $user
     * @return RedirectResponse
     */
    protected function redirectUserBasedOnType(User $user): RedirectResponse
    {
        if ($user->usertype === 'admin') {
            return redirect()->route('admin.dashboards');
        } elseif ($user->usertype === 'subadmin') {
            return redirect()->route('subadmin.subdashboards');
        }

        return redirect()->route('articles'); // Default redirect for regular users
    }

    /**
     * Extract credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function getCredentials(Request $request): array
    {
        $loginIdentifier = $request->input('login_identifier');
        $password = $request->input('password');

        return filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL)
            ? ['email' => $loginIdentifier, 'password' => $password, 'usertype' => 'user']
            : ['student_id' => $loginIdentifier, 'password' => $password, 'usertype' => 'user'];
    }


public function showRegistrations(): View
{
    // Fetch users with a pending account status
    $users = User::where('account_status', 'pending')
        ->whereNotIn('usertype', ['admin', 'subadmin']) // Exclude admin and subadmin
        ->get();

    return view('admin.registrations', compact('users'));
}
public function approveRegistration(User $user): RedirectResponse
{
    $user->account_status = 'approved';
    $user->save();

    $user->notify(new \App\Notifications\RegistrationApproved());

    return redirect()->route('admin.registrations')->with('success', 'User approved and notified.');
}


public function rejectRegistration(Request $request, User $user): RedirectResponse
{
    $request->validate([
        'rejection_reason' => 'required|string',
    ]);

    // Send notification before deleting the user
    $user->notify(new \App\Notifications\RegistrationRejected($request->input('rejection_reason')));

    // Delete the user's data
    $user->delete();

    return redirect()->route('admin.registrations')->with('success', 'User registration rejected.');
}

}
