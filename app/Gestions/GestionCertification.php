<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Certification};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionCertification
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $certificat = Certification::create($request->all());

		return response()->json($certificat,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Certification $certificat)
	{

        $certificat->update($request->all());

		return response()->json($certificat,200);

	}

    /** la methode delete */

	public function delete(Certification $certificat)
	{

        $certificat->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>