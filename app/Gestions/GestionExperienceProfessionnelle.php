<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{ExperienceProfessionnelle};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionExperienceProfessionnelle
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $experience = ExperienceProfessionnelle::create($request->all());

		return response()->json($experience,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , ExperienceProfessionnelle $experience)
	{

        $experience->update($request->all());

		return response()->json($experience,200);

	}

    /** la methode delete */

	public function delete(ExperienceProfessionnelle $experience)
	{

        $experience->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>