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
	public function all(){

		try {

            $certifications = Certification::all();

            if(is_null($certifications)) return response()->json(['status'=>false, 'message'=>'La liste des certifications est vide'], 200);

            return response()->json([
				'status'  => true,
				'content' => $certifications ,
			], 200);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
        }

	}

	/**
	 * Retourne une certification
	 * @access public
	 * @param $id
	 * @return Response
	 * 
	 */
	public function find($id){

		try {

            $certification = Certification::find($id);

            if(is_null($certification)) return response()->json(['status'=>false, 'message'=>'Oopps certification non trouvée.'], 200);

            return response()->json([
				'status'  => true,
				'content' => $certification ,
			], 200);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
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
								'id_profil' => $data->id_profil,
								'nom' => $data->nom,
								'organisme_delivrance' => $data->organisme_delivrance,
                                'level' => $data->level,
								'date_certification' => $data->date_certification
							]);

            if(is_null($certification)) return response()->json(['status'=>false, 'message'=>'Oopps une erreur est survenue.'], 200);

            return response()->json([
				'status' => true,
				'id' => $certification->id_competence ,
				'message' => trans("Certification créée avec succès")
			]);
	
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
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

            $certification = Certification::find($id);
			$status     = false;

            if(is_null($certification)) return response()->json(['status'=>$status, 'message'=>'Desolee, Cette certification n\'existe pas.'], 200);
			
			$certification->update([
				'id_profil' => $data->id_profil,
                'nom' => $data->nom,
                'organisme_delivrance' => $data->organisme_delivrance,
                'level' => $data->level,
                'date_certification' => $data->date_certification
			]);

			$status = true;

            return response()->json([
				'status' => $status,
				'message' => "Certification modifiée avec succès"
			]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
        }
	}

	/**
	 * Supprime une certification
	 * @access public
	 * @param $id
	 * @return Response
	 * 
	 */
	public function delete($id)
	{
		try {

            $certification = Certification::find($id);
			$status     = false;

            if(is_null($certification)) return response()->json(['status'=>$status, 'message'=>'Desolee, Cette certification n\'existe pas.'], 200);
			
			$certification->delete();
			$status = true;

            return response()->json([
				'status' => $status,
				'message' => "certification supprimée avec succès"
			]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
        }
	}
}
