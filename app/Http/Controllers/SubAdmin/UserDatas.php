<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserDatas extends Controller
{
    public function index()
{
    // Retrieve all users except admins
    $users = User::whereNotIn('usertype', ['admin', 'subadmin'])->get();


    return view('subadmin.userdata.index', compact('users'));
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

        return redirect()->route('subadmin.users.index')->with('success', 'User created successfully');
    }
}