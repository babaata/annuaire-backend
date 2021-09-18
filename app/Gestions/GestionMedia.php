<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Media};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionMedia
{
	/** La methode de stockage */
	
	public function store(Request $request)
	{
        $newsletter = Media::create($request->all());

		return response()->json($newsletter,201);
		
	}

	/** La methode de modification */

	public function update(Request $request , Media $newsletter)
	{

        $newsletter->update($request->all());

		return response()->json($newsletter,200);

	}

    /** la methode delete*/

	public function delete(Media $newsletter)
	{

        $newsletter->delete($request->all());

		return response()->json(null , 204);

	}

	
}
 ?>