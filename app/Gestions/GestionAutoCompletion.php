<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur, Pays, Competence, ExperienceProfessionnelle};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionAutoCompletion
{	
	public function data($request, $ressource)
	{
		$data = [];

		if ($request->has('terme')) {
			switch ($ressource) {
				case 'competence':
					$data = $this->getCompetence($request->terme);
					break;
				case 'experience':
					$data = $this->getExperienceProfessionnelle($request->terme);
					break;
				case 'pays':
					$data = $this->getPays($request->terme);
					break;
			}
		}
			
		return response()->json([
			'status' => true,
			'data' => $data
		]);
	}

	public function getPays($terme)
	{
		return Pays::where('nom', 'LIKE', "%$terme%")->get();
	}

	public function getCompetence($terme)
	{
		return Competence::where('nom', 'LIKE', "%$terme%")->groupBy('nom')->get();
	}

	public function getExperienceProfessionnelle($terme)
	{
		return ExperienceProfessionnelle::where('poste', 'LIKE', "%$terme%")->groupBy('poste')->get();
	}
}

?>