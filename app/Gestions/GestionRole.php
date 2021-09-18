<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Role};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionRole
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $role = Role::create($request->all());

		return response()->json($role,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Role $role)
	{

        $role->update($request->all());

		return response()->json($role,200);

	}

    /** la methode delete*/

	public function delete(Role $role)
	{

        $role->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>