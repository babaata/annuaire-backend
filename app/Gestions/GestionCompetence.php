<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Competence};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionCompetence
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $compet = Competence::create($request->all());

		return response()->json($compet,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Competence $compet)
	{

        $compet->update($request->all());

		return response()->json($compet,200);

	}

    /** la methode delete */

	public function delete(Competence $compet)
	{

        $compet->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>