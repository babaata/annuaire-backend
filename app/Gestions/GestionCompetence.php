<?php 
namespace App\Gestions;
use App\Models\Competence;
use DB;
class GestionCompetence
{
	/**
	 * Retourne toutes les competences
	 * @access public
	 * @return Response 
	 */
	public function all(){

		try {

            $competences = Competence::all();

            if(is_null($competences)) return response()->json(['status'=>false, 'message'=>'La liste des competences est vide'], 200);

            return response()->json([
				'status'  => true,
				'content' => $competences ,
			], 200);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
        }

	}

	/**
	 * Retourne une competence
	 * @access public
	 * @param $id
	 * @return Response
	 * 
	 */
	public function find($id){

		try {

            $competence = Competence::find($id);

            if(is_null($competence)) return response()->json(['status'=>false, 'message'=>'Oopps competence non trouvée.'], 200);

            return response()->json([
				'status'  => true,
				'content' => $competence ,
			], 200);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
        }
	}

	/**
	 * Enregistre une competence
	 * @access public
	 * @param $CompetenceRequest
	 * @return Response
	 */
    public function store($data)
	{
		try {

            $competence = Competence::create([
								'id_profil' => $data->id_profil,
								'nom' => $data->nom,
								'niveau' => $data->niveau
							]);

            if(is_null($competence)) return response()->json(['status'=>false, 'message'=>'Oopps une erreur est survenue.'], 200);

            return response()->json([
				'status' => true,
				'id' => $competence->id_competence ,
				'message' => trans("Competence créée avec succès")
			]);
	
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
        }
	}

	/**
	 * Mettre à jours une competence
	 * @access public
	 * @param $CompetenceRequest, $id
	 * @return Response
	 */

	public function update($data, $id)
	{
		try {

            $competence = Competence::find($id);
			$status     = false;

            if(is_null($competence)) return response()->json(['status'=>$status, 'message'=>'Desolee, Cette competence n\'existe pas.'], 200);
			
			$competence->update([
				'id_profil' => $data->id_profil,
				'nom' => $data->nom,
				'niveau' => $data->niveau
			]);

			$status = true;

            return response()->json([
				'status' => $status,
				'message' => "Competence modifiée avec succès"
			]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
        }
	}

	/**
	 * Supprime une competence
	 * @access public
	 * @param $id
	 * @return Response
	 * 
	 */
	public function delete($id)
	{
		try {

            $competence = Competence::find($id);
			$status     = false;

            if(is_null($competence)) return response()->json(['status'=>$status, 'message'=>'Desolee, Cette competence n\'existe pas.'], 200);
			
			$competence->delete();
			$status = true;

            return response()->json([
				'status' => $status,
				'message' => "Competence supprimée avec succès"
			]);
            
        } catch(\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage() ,
			], $e->getCode());
        }
	}
}
