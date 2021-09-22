<?php 
namespace App\Gestions;
use App\Models\Certification;
use DB;
class GestionCertification
{
	/**
	 * Retourne la liste des certifications
	 * @access public
	 * @return Response 
	 */
	public function all($request){

		try {

			$certifications = Certification::whereIn('id_profil', function ($query) use ($request){
	            $query->from('profil')->whereIdUtilisateur($request->user()->id_utilisateur)
	            ->select('id_profil')->get();
	        })->with('profil')->get();

	        return response()->json([
	            'status' => true,
	            'certifications' => $certifications
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

			$certifications = Certification::whereIn('id_profil', function ($query) use ($request){
	            $query->from('profil')->whereIdUtilisateur($request->user()->id_utilisateur)
	            ->select('id_profil')->get();
	        })->whereIdCertification($id)->with('profil');

	        return response()->json([
	            'status' => $certifications->exists(),
	            'certification' => $certifications->exists() ? $certifications->first():null
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

            $certification = Certification::create([
				'id_profil' => $data->profil,
				'nom' => $data->nom,
				'organisme_delivrance' => $data->organisme,
                'level' => $data->level,
				'date_certification' => $data->date_certification
			]);

            return response()->json([
				'status' => true,
				'id' => $certification->id_certification,
				'message' => trans("Certification créée avec succès")
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

			$certification = Certification::whereIn('id_profil', function ($query) use ($data){
	            $query->from('profil')->whereIdUtilisateur($data->user()->id_utilisateur)
	            ->select('id_profil')->get();
	        })->whereIdCertification($id);

	        if ($certification->exists()) {

	        	$certification->first()->update([
					'id_profil' => $data->profil,
                	'nom' => $data->nom,
                	'organisme_delivrance' => $data->organisme,
                	'level' => $data->level,
                	'date_certification' => $data->date_certification
				]);
	        }

	        $status = $certification->exists();

			return response()->json([
				'status' => $status,
				'id' => $status ? $certification->first()->id_certification:null,
				'message' => $status ? "Certification modifié avec succès":"Certification invalide"
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

			$certification = Certification::whereIn('id_profil', function ($query) use ($data){
				$query->from('profil')->whereIdUtilisateur($data->user()->id_utilisateur)
				->select('id_profil')->get();
			})->whereIdCertification($id);

			$status = $certification->exists();

			$certification->delete();

            return response()->json([
				'status' => $status,
				'message' => $status ? "Certification supprimée avec succès":"Certification invalide"
			]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			]);
        }
	}
}
