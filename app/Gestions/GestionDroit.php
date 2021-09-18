<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Droit};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionDroit
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $permission = Droit::create($request->all());

		return response()->json($permission,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Droit $permission)
	{

        $permission->update($request->all());

		return response()->json($permission,200);

	}

    /**la methode delete */

	public function delete(Droit $permission)
	{

        $permission->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>