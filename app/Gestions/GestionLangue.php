<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur, Profil, Langue, UtilisateurLangue, UtilisateurLangue};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionLangue
{	
	public function store($data)
	{
		$langue = UtilisateurLangue::firstOrCreate([
			'id_langue' => $data->langue,
			'id_utilisateur' => $data->user()->id_utilisateur
		]);

		$langue->update(['niveau' => $data->niveau]);

		return response()->json([
			'status' => true,
			'langue' => $langue,
			'message' => trans("Langue créé avec succès")
		]);
	}

	public function update($data, $id)
	{
		$langues = $data->user()->langues()->whereIdLangue($id);

		if ($langues->exists()) {
			
			$langue = UtilisateurLangue::firstOrCreate([
				'id_langue' => $langues->first()->id_langue,
				'id_utilisateur' => $data->user()->id_utilisateur
			]);

			$langue->update(['niveau' => $data->niveau]);
		}

		return response()->json([
			'status' => $langues->exists(),
			'langue' => $langues->exists() ? $langues->first():null,
			'message' => $status ? "Langue modifié avec succès":"Langue invalide"
		]);
	}

	public function delete($data, $id)
	{
		$langues = UtilisateurLangue::whereIdUtilisateur($data->user()->id_utilisateur)
		->whereIdLangue($id);

		if ($langues->exists()) $langues->first()->delete();

		return response()->json([
			'status' => $langues->exists(),
			'message' => $langues->exists() ? "Langue supprimé avec succès":"Langue invalide"
		]);
	}
}

?>