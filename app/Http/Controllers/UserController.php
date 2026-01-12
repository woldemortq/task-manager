<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function users()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function userLogin(Request $request)
    {
        $name = request()->name;
        $password = request()->password;

        $user = User::where('name', $name)->where('password', $password)->where('role', 'user')->first();

        if ($user) {
            return redirect()->route('tasks.index');
        }
        return back()->with('error', 'Wrong username or password');
    }

    public function admin()
    {
        $users = User::all();
        return view('admins.admin', compact('users'));
    }

    public function adminLogin(Request $request)
    {
        $name = request()->name;
        $password = request()->password;

        $admin = User::where('name', $name)->where('password', $password)->where('role', 'admin')->first();

        if ($admin) {
            return redirect()->route('admin.create.users', compact('admin'));
        }
        return back()->with('error', 'Wrong username or password');
    }

    public function createUsers()
    {
        $users = User::all();
        $roles = Role::cases();
        return view('admins.create', compact('users', 'roles'));
    }

    public function storeUsers()
    {
        $usersAndAdmins = request()->validate([
            'name' => 'string',
            'email' => 'string',
            'password' => 'string',
            'role' => 'string|in:Admin,User'
        ]);

        User::create($usersAndAdmins);
        return redirect()->route('admin.index');
    }


}
