<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('name', $credentials['name'])
            ->where('role', 'user')
            ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
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

    public function storeUsers(Request $request)
    {
        $usersAndAdmins = request()->validate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'string|in:Admin,User'
        ]);

        User::create($usersAndAdmins);
        return redirect()->route('admin.index');
    }


}
