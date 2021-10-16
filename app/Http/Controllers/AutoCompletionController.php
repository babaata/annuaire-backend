<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gestions\{GestionAutoCompletion};

class AutoCompletionController extends Controller
{
    public function index(Request $request, GestionAutoCompletion $gestion, $ressource)
    {
        return $gestion->data($request, $ressource);
    }
}
