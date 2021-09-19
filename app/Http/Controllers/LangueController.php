<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{LangueCreateRequest,LangueUpdateRequest};
use App\Gestions\{GestionLangue};
use App\Models\{Langue, Profil};

class LangueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'status' => true,
            'langue' => $request->user()->langues
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LangueCreateRequest $request , GestionLangue $gestionLang)
    {
        return $gestionLang->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id = null)
    {
        return response()->json([
            'status' => true,
            'langue' => $request->user()->langues()->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LangueUpdateRequest $request, GestionLangue $gestionLang , $id = null);
    {
        return $gestionLang->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , GestionLangue $gestionLang , $id = null)
    {
        return $gestionLang->delete($request, $id);
    }
}
