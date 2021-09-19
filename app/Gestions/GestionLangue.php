<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur, Profil, Langue};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionLangue
{	
	public function store($data)
	{
		$langue = Langue::firstOrCreate([
			'nom' => $data->nom,
			'id_utilisateur' => $data->user()->id_utilisateur
		]);

		return response()->json([
			'status' => true,
			'id' => $langue->id_langue,
			'message' => trans("Langue créé avec succès")
		]);
	}

	public function update($data, $id)
	{
		$langues = $data->user()->langues()->whereIdLangue($id);

		if ($langues->exists()) {
			
			$langues->first()->update([
				'nom' => $data->nom,
			]);
		}

		return response()->json([
			'status' => $langues->exists(),
			'id' => $langues->exists() ? $langues->first()->id_langue:null,
			'message' => $status ? "Langue modifié avec succès":"Langue invalide"
		]);
	}

	public function delete($data, $id)
	{
		$langues = $data->user()->profils()->whereIdLangue($id);

		if ($langues->exists()) $langues->first()->delete();

		return response()->json([
			'status' => $langues->exists(),
			'message' => $langues->exists() ? "Langue supprimé avec succès":"Langue invalide"
		]);
	}
}

?>