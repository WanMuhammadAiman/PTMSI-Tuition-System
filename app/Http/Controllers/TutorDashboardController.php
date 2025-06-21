<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Material;

class TutorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get 3 most recent materials uploaded by this tutor
        $recentMaterials = Material::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('tutor.dashboard', compact('user', 'recentMaterials'));
    }
}

