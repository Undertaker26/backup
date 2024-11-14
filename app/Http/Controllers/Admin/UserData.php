<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserData extends Controller
{
    public function index()
{
    // Retrieve all users except admins
    // $users = User::where('usertype', '!=', 'admin')->get();
    $users = User::where('account_status', 'approved') // Adjust this condition if needed
    ->whereNotIn('usertype', ['admin', 'subadmin'])
    ->get();

    return view('admin.userdata.index', compact('users'));
}

    

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:users',
            'username' => 'required|unique:users',
            'course' => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:users',
            'usertype' => 'required',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }
}