<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{LangueCreateRequest, LoginRequest, LangueUpdateRequest};
use App\Gestions\{GestionLangue};
use App\Models\{Utilisateur, Profil, Langue, Pays};

class PaysController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'pays' => Pays::get()
        ]);
    }
}
