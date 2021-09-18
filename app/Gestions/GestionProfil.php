<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur, Profil};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionProfil
{	
	public function store($data)
	{
		$user = $data->user();

		$profil = Profil::create([
			'titre' => $data->titre,
			'resume' => $data->resume,
			'id_utilisateur' => $data->user()->id_utilisateur
		]);

		return response()->json([
			'status' => true,
			'id' => $profil->id_profil,
			'message' => trans("Profil créé avec succès")
		]);
	}

	public function update($data, $id)
	{
		$user = $data->user();

		$profils = $user->profils()->whereIdProfil($id);

		$status = false;

		if ($profils->exists()) {
			
			$profils->first()->update([
				'titre' => $data->titre,
				'resume' => $data->resume,
			]);

			$status = true;
		}

		return response()->json([
			'status' => $status,
			'id' => $status ? $profils->first()->id_profil:null,
			'message' => $status ? "Profil modifié avec succès":"Profil invalide"
		]);
	}

	public function delete($data, $id)
	{
		$user = $data->user();

		$profils = $user->profils()->whereIdProfil($id);

		$status = false;

		if ($profils->exists()) {
			$profils->first()->delete();
			$status = true;
		}

		return response()->json([
			'status' => $status,
			'message' => $status ? "Profil supprimé avec succès":"Profil invalide"
		]);
	}
}
 ?>