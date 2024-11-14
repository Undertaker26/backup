<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BanHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function showImportForm()
{
    return view('admin.users.import'); // Make sure this view exists
}
public function import(Request $request)
{
    // Validate that a file is provided and it's a CSV
    $request->validate([
        'file' => 'required|mimes:csv,txt',
    ]);

    // Open and read the file
    $file = fopen($request->file('file')->getRealPath(), 'r');

    // Skip the first row if it contains headers
    $isHeader = true;

    while (($row = fgetcsv($file, 1000, ',')) !== false) {
        if ($isHeader) {
            $isHeader = false;
            continue;
        }

        // Extract data from the row
        $studentId = $row[0];
        $username = $row[1];
        $course = $row[2];
        $status = $row[3];
        $email = $row[4];
        $province = $row[5] ?? null;
        $city = $row[6] ?? null;
        $barangay = $row[7] ?? null;
        $bday = isset($row[8]) ? \Carbon\Carbon::createFromFormat('Y-m-d', $row[8]) : null;

        $validStatuses = ['current_student', 'alumni', 'other'];
        if (!in_array($status, $validStatuses)) {
            continue; // Skip invalid statuses or handle as needed
        }

        // Check if a user with the same student_id or email exists
        $existingUser = User::where('student_id', $studentId)
                            ->orWhere('email', $email)
                            ->first();

        // If user exists and is not an admin, delete the old record
        if ($existingUser && $existingUser->usertype != 'admin') {
            $existingUser->delete();
        }

        // Create a new user with the data
        $user = new User();
        $user->student_id = $studentId;
        $user->username = $username;
        $user->course = $course;
        $user->status = $status;
        $user->email = $email;
        $user->province = $province;
        $user->city = $city;
        $user->barangay = $barangay;
        $user->bday = $bday;

        // Generate a strong password
        $newPassword = Str::random(12);
        $user->password = Hash::make($newPassword); // Set the password

        $user->account_status = 'approved'; // Set default status
        $user->save();

        // Send the new password to the user via email
        Mail::to($user->email)->send(new \App\Mail\NewPasswordMail($user, $newPassword));
    }

    fclose($file);

    return redirect()->route('admin.users.index')->with('success', 'Users imported successfully, with new passwords sent.');
}


    public function index(Request $request)
    {
        // Fetch approved users, excluding admin and subadmin
        $users = User::where('account_status', 'approved') // Adjust this condition if needed
            ->whereNotIn('usertype', ['admin', 'subadmin'])
            ->get();
    
        // Fetch count of pending users
        $pendingCount = User::where('account_status', 'pending')
        ->whereNotIn('usertype', ['admin', 'subadmin'])
        ->count();


    
        // Search functionality
        $query = $request->input('search');
        
        $users = User::query()
            ->when($query, function ($q) use ($query) {
                return $q->where('username', 'like', "%{$query}%")
                         ->orWhere('student_id', 'like', "%{$query}%");
            })
            ->whereNotIn('usertype', ['admin', 'subadmin'])
            ->where('account_status', 'approved')
            ->paginate(10); // Adjust pagination as needed
    
        return view('admin.users.index', compact('users', 'pendingCount'));
    }
    

    public function create()
    {
        return view('admin.users.create');
    }

public function searchSuggestions(Request $request)
{
    $query = $request->input('query');
    
    $users = User::where(function($queryBuilder) use ($query) {
        $queryBuilder->where('username', 'like', "%{$query}%")
                     ->orWhere('student_id', 'like', "%{$query}%");
    })
    ->limit(10) // Limit the number of suggestions
    ->get(['id', 'username', 'student_id']);

    return response()->json($users);
}


// public function listUsers(): View
// {
//     $users = User::where('status', 'approved')->get();
//     return view('admin.users.index', compact('users'));
// }
public function backup()
{
    // Fetch all users excluding admins and subadmins
    $users = User::whereNotIn('usertype', ['admin', 'subadmin'])->get();

    // Backup filename
    $filename = 'users_backup_' . date('Y-m-d_H-i-s') . '.csv';

    // Open the CSV file for writing
    $handle = fopen($filename, 'w+');

    // Add CSV headers
    fputcsv($handle, ['Student ID', 'Username', 'Course', 'Status', 'Email', 'Province', 'City', 'Barangay', 'Birthday', 'Date Created']);

    // Process each user without changing passwords or sending emails
    foreach ($users as $user) {
        // Write user data to CSV
        $bday = $user->bday ? \Carbon\Carbon::parse($user->bday)->format('Y-m-d') : '';

        fputcsv($handle, [
            $user->student_id,
            $user->username,
            $user->course,
            $user->status,
            $user->email,
            $user->province,
            $user->city,
            $user->barangay,
            $bday,
            $user->created_at,
        ]);
    }

    // Close the file handle
    fclose($handle);

    // Return the file as a download and delete it after sending
    return response()->download($filename)->deleteFileAfterSend(true);
}



   public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}


 
public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|unique:users',
        'username' => 'required|unique:users',
        'course' => 'required',
        'status' => 'required|in:current_student,alumni,other', 
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
    ]);

    $data = $request->all();
    $data['password'] = bcrypt($data['password']);
    $data['usertype'] = 'users';
    


    User::create($data);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully');
}

    public function ban(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Validate the incoming request data
        $request->validate([
            'ban_reason' => 'required|string|max:255',
            'ban_duration' => 'required|integer|min:1',
        ]);
        
        // Convert the ban duration to an integer
        $banDuration = (int) $request->input('ban_duration');
        
        // Calculate the end date of the ban
        $banEndDate = now()->addDays($banDuration);
    
        // Create a new ban history record
        BanHistory::create([
            'user_id' => $user->id,
            'ban_reason' => $request->input('ban_reason'),
            'ban_duration' => $banDuration,
            'banned_until' => $banEndDate,
            'is_active' => true, // This ban is active
        ]);
    
        // Update the user's ban details
        $user->banned_until = $banEndDate;
        $user->ban_reason = $request->input('ban_reason');
        $user->save();
    
        return redirect()->route('admin.users.index')->with('success', 'User has been banned successfully for ' . $banDuration . ' days.');
    }
    public function unban($id)
{
    $user = User::findOrFail($id);

    // Find the active ban history
    $activeBan = BanHistory::where('user_id', $user->id)->where('is_active', true)->first();

    if ($activeBan) {
        $activeBan->is_active = false;
        $activeBan->save();

        // Unban the user
        $user->banned_until = null;
        $user->ban_reason = null;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User has been unbanned successfully.');
    }

    return redirect()->route('admin.users.index')->with('error', 'No active ban found for this user.');
}
public function banForm($id)
{
    $user = User::findOrFail($id);
    return view('admin.ban_form', compact('user'));
}


    public function update(Request $request, User $user)
    {
        $request->validate([
            'student_id' => 'required|unique:users,student_id,' . $user->id,
            'username' => 'required|unique:users,username,' . $user->id,
            'course' => 'required',
            'status' => 'required|in:current_student,alumni', // Validate against the possible status values
            'email' => 'required|email|unique:users,email,' . $user->id,
            'usertype' => 'required',
            'password' => 'nullable|min:8',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
    
}
