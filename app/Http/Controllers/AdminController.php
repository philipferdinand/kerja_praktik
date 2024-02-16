<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Check if the provided credentials are for the admin user
        if ($credentials['username'] == 'admin' && $credentials['password'] == 'admin') {
            // Valid admin credentials, log in
            Auth::guard('admin')->loginUsingId(1); // You might need to adjust the user ID based on your database

            // Redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // Invalid credentials for admin, redirect back with an error message
        return redirect()->route('admin.login')->with('error', 'Invalid admin credentials');
    }

    public function dashboard()
    {
        $users = User::paginate(10); // Change 10 to the number of users you want per page
        return view('admin.dashboard', compact('users'));
    }


    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $users = User::query();

        if ($search) {
            $users->where('nama', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('instagram', 'like', '%' . $search . '%');
        }

        if ($status) {
            $users->where('status', $status);
        }

        $users = $users->paginate(10);

        return view('admin.dashboard', compact('users'));
    }
}

