<?php

// app/Http/Controllers/AController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AnalisisController extends Controller
{

    public function hasil()
    {
        $users = User::with('hasilAnalisis')->get(); // Gantilah sesuai dengan model User Anda
        return view('analisis.hasil', compact('users'));
    }

}

