<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Education};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionEducation
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $educat = Education::create($request->all());

		return response()->json($educat,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Education $educat)
	{

        $educat->update($request->all());

		return response()->json($educat,200);

	}

    /** la methode delete */

	public function delete(Education $educat)
	{

        $educat->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>