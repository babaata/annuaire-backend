<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Adresse};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionAdresse
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $addr = Address::create($request->all());

		return response()->json($addr,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Address $addr)
	{

        $addr->update($request->all());

		return response()->json($addr,200);

	}

	public function delete(Address $addr)
	{

        $addr->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>