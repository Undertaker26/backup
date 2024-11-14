<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    // Update profile information
public function update(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = auth()->user();

    if ($request->hasFile('profile_image')) {
        $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image_url = $imagePath;
    }

    $user->username = $request->username;
    $user->email = $request->email;
    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
}

// Change password
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'nullable|string|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    if ($request->new_password) {
        $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
}

// Delete account
public function destroy()
{
    $user = auth()->user();
    $user->delete();

    return redirect()->route('home')->with('success', 'Account deleted successfully.');
}

    public function show()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('profile.show', compact('user', 'posts'));
    }

    /**
     * Show the profile edit form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile.
     *
     * @param Request $request
     * @return RedirectResponse
    //  */
    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
    //     ]);

    //     $user = Auth::user();
    //     $user->username = $request->username;
    //     $user->email = $request->email;
    //     $user->save();

    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }

    // // Update user password
    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'new_password' => 'nullable|string|min:8|confirmed',
    //     ]);

    //     $user = Auth::user();

    //     if ($request->new_password) {
    //         $user->password = Hash::make($request->new_password);
    //         $user->save();
    //     }

    //     return redirect()->back()->with('success', 'Password updated successfully.');
    // }

    // // Delete user account
    // public function destroy(Request $request)
    // {
    //     $user = Auth::user();
    //     $user->delete();

    //     return redirect('/')->with('success', 'Account deleted successfully.');
    // }
    public function uploadImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Adjust validation rules as needed
        ]);
    
        $user = auth()->user();
    
        // Handle file upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_images', $filename);
    
            // Update user profile image URL in the database
            $user->profile_image_url = 'profile_images/' . $filename;
            $user->save();
    
            return response()->json([
                'success' => true,
                'imageUrl' => asset('storage/profile_images/' . $filename)
            ]);
        }
    
        return response()->json(['success' => false]);
    }
    
}