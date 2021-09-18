<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{TypeContrat};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionTypeContrat
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $type_contrat = TypeContrat::create($request->all());

		return response()->json($type_contrat,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , TypeContrat $type_contrat)
	{

        $type_contrat->update($request->all());

		return response()->json($type_contrat,200);
        

	}

    /** la methode delete */

	public function delete(TypeContrat $type_contrat)
	{

        $type_contrat->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>