<?php 
namespace App\Gestions;
use App\Models\{ExperienceProfessionnelle};
use DB;
class GestionExperience
{
	/**
	 * Retourne la liste des certifications
	 * @access public
	 * @return Response 
	 */
	public function all($request){

		try {

			$exps = ExperienceProfessionnelle::whereIn('id_profil', function ($query) use ($request){
	            $query->from('profil')->whereIdUtilisateur($request->user()->id_utilisateur)
	            ->select('id_profil')->get();
	        })->with('profil')->get();

	        return response()->json([
	            'status' => true,
	            'experiences' => $exps
	        ]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			]);
        }
	}

	/**
	 * Retourne une certification
	 * @access public
	 * @param $id
	 * @return Response
	 * 
	 */
	public function find($data, $id){

		try {

			$exp = ExperienceProfessionnelle::whereIn('id_profil', function ($query) use ($request){
	            $query->from('profil')->whereIdUtilisateur($request->user()->id_utilisateur)
	            ->select('id_profil')->get();
	        })->whereIdExperienceProfessionnelle($id)->with('profil');

	        return response()->json([
	            'status' => $exp->exists(),
	            'experience' => $exp->exists() ? $exp->first():null
	        ]);
            
        } catch(\Exception $e) {
			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			]);
        }
	}

	/**
	 * Enregistre une certification
	 * @access public
	 * @param $CertificationsRequest
	 * @return Response
	 */
    public function store($data)
	{

		try {

            $exp = ExperienceProfessionnelle::create([
				'entreprise' => $data->entreprise,
				'poste' => $data->poste,
				'date_debut' => $data->debut,
				'date_fin' => $data->fin,
				'description' => $data->description,
				'id_profil' => $data->profil,
				'id_type_contrat' => $data->type_contrat
			]);

            return response()->json([
				'status' => true,
				'id' => $exp->id_experience_professionnelle,
				'message' => trans("Experience professionnelle créée avec succès")
			]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			]);
        }
	}

	/**
	 * Mettre à jours une certification
	 * @access public
	 * @param $CertificationsRequest, $id
	 * @return Response
	 */

	public function update($data, $id)
	{
		try {

			$exp = ExperienceProfessionnelle::whereIn('id_profil', function ($query) use ($data){
	            $query->from('profil')->whereIdUtilisateur($data->user()->id_utilisateur)
	            ->select('id_profil')->get();
	        })->whereIdExperienceProfessionnelle($id);

	        if ($exp->exists()) {

	        	$exp->first()->update([
					'entreprise' => $data->entreprise,
					'poste' => $data->poste,
					'date_debut' => $data->debut,
					'date_fin' => $data->fin,
					'description' => $data->description,
					'id_profil' => $data->profil,
					'id_type_contrat' => $data->type_contrat
				]);
	        }

	        $status = $exp->exists();

			return response()->json([
				'status' => $status,
				'id' => $status ? $exp->first()->id_experience_professionnelle:null,
				'message' => $status ? "Experience professionnelle modifié avec succès":"Certification invalide"
			]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			]);
        }
	}

	/**
	 * Supprime une certification
	 * @access public
	 * @param $id
	 * @return Response
	 * 
	 */
	public function delete($data, $id)
	{

		try {

			$exp = ExperienceProfessionnelle::whereIn('id_profil', function ($query) use ($data){
				$query->from('profil')->whereIdUtilisateur($data->user()->id_utilisateur)
				->select('id_profil')->get();
			})->whereIdExperienceProfessionnelle($id);

			$status = $exp->exists();

			$exp->delete();

            return response()->json([
				'status' => $status,
				'message' => $status ? "Experience professionnelle supprimée avec succès":"Certification invalide"
			]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			]);
        }
	}
}
