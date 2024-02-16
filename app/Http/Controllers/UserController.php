<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'gender' => 'required|in:male,female,other',
            'birthdate' => 'required|date',
            'instagram' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'status' => 'required',
        ]);

        User::create($validatedData);

        return redirect()->route('welcome')->with('success', 'Data berhasil disimpan!');
    }

    public function updateStatus(Request $request, $userId)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:Cancelled', // Pastikan status yang diterima adalah "Cancelled"
        ]);

        // Temukan pengguna berdasarkan ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update status pengguna
        $user->status = $request->input('status');
        $user->save();

        return response()->json(['message' => 'User status updated successfully']);
    }

    public function index(Request $request)
    {
        $query = User::query();

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('instagram', 'like', "%$search%");
            });
        }

        // Handle filter
        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        
    }

}
