<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Referent};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionReferent
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $referent = Referent::create($request->all());

		return response()->json($referent,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Referent $referent)
	{

        $referent->update($request->all());

		return response()->json($referent,200);

	}

    /** la methode delete */

	public function delete(Referent $referent)
	{

        $referent->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>