<?php

// app/Http/Controllers/AController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\HasilAnalisis;
use Illuminate\Pagination\Paginator;

class HasilAnalisisController extends Controller
{

    public function simpanHasil(Request $request) {
        $data = $request->all();
        $hasilAnalisis = $data['hasilAnalisis'];
    
        // insert ke table hasil_analisis
        $inserted = new HasilAnalisis();
        $inserted->user_id = $data['user_id'];
        $inserted->description = $hasilAnalisis['description'];
        $inserted->metaphor = $hasilAnalisis['metaphor'];
        $inserted->core_1 = $hasilAnalisis['core_1'];
        $inserted->core_2 = $hasilAnalisis['core_2'];
        $inserted->core_3 = $hasilAnalisis['core_3'];
        $inserted->core_4 = $hasilAnalisis['core_4'];
        $inserted->color = $hasilAnalisis['color'];
        $inserted->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function hasil()
    {
        $hasilAnalisis = HasilAnalisis::paginate(10);
        return view('analisis.hasil', compact('hasilAnalisis'));
    }
}

