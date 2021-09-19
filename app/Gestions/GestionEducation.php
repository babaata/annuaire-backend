<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur, Profil, Education};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionEducation
{	
	public function store($data)
	{
		$profil = $data->user()->profils()->find($data->profil);

		$parcour = null;
		$message = "Erreur";

		if ($profil) {
			$parcour = Education::create([
				'ecole' => $data->ecole,
				'type_diplome' => $data->diplome,
				'date_debut' => $data->debut,
				'date_fin' => $data->fin,
				'description' => $data->description,
				'id_profil' => $profil->id_profil
			]);

			$message = trans("parcours scolaire créé avec succès");
			$parcour = $parcour->id_education;
		}

		
		return response()->json([
			'status' => $profil ? true:false,
			'id' => $parcour,
			'message' => $message
		]);
	}

	public function update($data, $id)
	{
		$education = Education::whereIn('id_profil', function ($query) use ($data){
			$query->from('profil')->whereIdUtilisateur($data->user()->id_utilisateur)
			->select('id_profil')->get();
		})->whereIdEducation($id);

		$status = false;

		$parcour = null;
		$message = "Erreur";

		if ($education->exists()) {
			$education->first()->update([
				'ecole' => $data->ecole,
				'type_diplome' => $data->diplome,
				'date_debut' => $data->debut,
				'date_fin' => $data->fin,
				'description' => $data->description,
			]);

			$message = trans("parcours scolaire modifié avec succès");
			$parcour = $education->first()->id_education;
		}

		
		return response()->json([
			'status' => $education->exists(),
			'id' => $parcour,
			'message' => $message
		]);
	}

	public function delete($data, $id)
	{
		$education = Education::whereIn('id_profil', function ($query) use ($data){
			$query->from('profil')->whereIdUtilisateur($data->user()->id_utilisateur)
			->select('id_profil')->get();
		})->whereIdEducation($id);

		$status = false;

		$parcour = null;
		$message = "Erreur";

		if ($education->exists()) {
			$parcour = $education->first()->id_education;
			$status = true;
			$education->delete();

			$message = trans("parcours scolaire supprimée avec succès");
			
		}

		return response()->json([
			'status' => $status,
			'id' => $parcour,
			'message' => $message
		]);
	}
}
 ?>