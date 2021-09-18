<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionUtilisateur
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $users = Utilisateur::create($request->all());

		return response()->json($users,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Utilisateur $users)
	{

        $users->update($request->all());

		return response()->json($users,200);

	}

	/** la methode delete */

	public function delete(Utilisateur $users)
	{

        $users->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>