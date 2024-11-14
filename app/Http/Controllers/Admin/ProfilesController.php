<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class ProfilesController extends Controller
{
    /**
     * Show the profile edit form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('admin.profile.edit');
    }

    /**
     * Update the profile.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // Update user password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    // Delete user account
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}