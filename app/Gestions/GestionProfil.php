<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur, Profil, Competence, ExperienceProfessionnelle};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionProfil
{	
	public function store($data)
	{
		$user = $data->user();

		//$data->user()->profil()->delete();

		$profil = Profil::firstOrCreate([
			'id_utilisateur' => $data->user()->id_utilisateur
		]);

		$user->update(['id_profil' => $profil->id_profil]);

		$profil->update(['resume' => $data->resume, 'titre' => $data->titre]);

		$profil->competences()->delete();
		$profil->experienceProfessionnelles()->delete();

		$this->addCompetences($data, $profil);
		$this->addExperiences($data, $profil);

		return response()->json([
			'status' => true,
			'id' => $profil->id_profil,
			'profil' => $profil->with('competences')->with('experienceProfessionnelles')->find($profil->id_profil),
			'message' => trans("Modification effectuée avec succès")
		]);
	}

	public function addCompetences($data, $profil)
	{
		if ($data->has('competences') AND is_array($data->competences)) {

			foreach ($data->competences as $key => $competence) {
				Competence::firstOrCreate([
					'id_profil' => $profil->id_profil,
					'nom' => $competence,
					'niveau' => $competence
				]);
			}
		}
				
	}

	public function addExperiences($data, $profil)
	{
		if ($data->has('experiences') AND is_array($data->experiences)) {

			foreach ($data->experiences as $key => $experience) {

				if (!isset($experience['dateDebut'])) continue;
				if (!isset($experience['dateFin'])) continue;
				if (!isset($experience['entreprise'])) continue;
				if (!isset($experience['poste'])) continue;
				if (!isset($experience['description'])) continue;

				$exp = ExperienceProfessionnelle::firstOrCreate([
					'entreprise' => $experience['entreprise'],
					'poste' => $experience['poste'],
					'date_debut' => $experience['dateDebut'],
					'date_fin' => $experience['dateFin'],
					'description' => $experience['description'],
					'id_profil' => $profil->id_profil,
				]);
			}
		}	
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