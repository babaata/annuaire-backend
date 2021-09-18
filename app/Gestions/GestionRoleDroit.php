<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{RoleDroit};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionRoleDroit
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $role_droit = RoleDroit::create($request->all());

		return response()->json($role_droit,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , RoleDroit $role_droit)
	{

        $role_droit->update($request->all());

		return response()->json($role_droit,200);

	}

	public function delete(RoleDroit $role_droit)
	{

        $role_droit->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>