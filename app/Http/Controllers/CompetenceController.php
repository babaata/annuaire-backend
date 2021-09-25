<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{CompetenceCreateRequest, CompetenceUpdateRequest};
use App\Gestions\{GestionCompetence};

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GestionCompetence $gestion)
    {
        return $gestion->all($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statistiques(Request $request, GestionCompetence $gestion)
    {
        return $gestion->statistiques($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, GestionCompetence $gestion)
    {
        return $gestion->extrais($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetenceCreateRequest $request, GestionCompetence $gestion)
    {
        return $gestion->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, GestionCompetence $gestion, $id)
    {
        return $gestion->find($request, $id);
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
    public function update(CompetenceUpdateRequest $request, GestionCompetence $gestion, $id)
    {
        return $gestion->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, GestionCompetence $gestion, $id)
    {
        return $gestion->delete($request, $id);
    }
}
