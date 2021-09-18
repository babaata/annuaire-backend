<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Langue};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionLangue
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $lang = Langue::create($request->all());

		return response()->json($lang,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Langue $lang)
	{

        $lang->update($request->all());

		return response()->json($lang,200);

	}

    /** la methode delete*/

	public function delete(Langue $lang)
	{

        $lang->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>