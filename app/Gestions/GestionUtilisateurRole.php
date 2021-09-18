<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{UtilisateurRole};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionUtilisateurRole
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $user_role = UtilisateurRole::create($request->all());

		return response()->json($user_role,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , UtilisateurRole $user_role)
	{

        $user_role->update($request->all());

		return response()->json($user_role,200);

	}

    /** la methode delete */

	public function delete(UtilisateurRole $user_role)
	{

        $user_role->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>