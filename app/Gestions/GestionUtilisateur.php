<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur, Profil};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GestionUtilisateur
{

	public function getBydId($user)
	{
		$user = Utilisateur::whereIdUtilisateur($user)
			->with(
				'profils.competences', 
				'profils.educations', 
				'profils.certifications',
				'profils.experienceProfessionnelles',
				'profils.langues'
			);

		return response()->json([
            "status" => $user->exists(),
            'user' => $user->first(),
            'message' => $user->exists() ? null:"Aucun utilisateur de ce nom"
        ]);
	}

	public function allUsers($limit = 10)
	{
		$users = Utilisateur::orderBy('date_de_creation')
			->with('profils')
			->limit($limit);

		return response()->json([
            "status" => true,
            'users' => $users->get()
        ]);
	}

	public function saveUserPicture($data)
	{
		$status = false;
		$image = null;
		if ($status = $data->file('image')->isValid()) {
            
            //store file into users pictures folder
            $image = $data->image->store('public/users');

            $data->user()->update([
            	'url_photo' => asset(Storage::url($image))
            ]);
        }

        return response()->json([
            "status" => $status,
            "message" => $status ? trans("Image téléchargée avec succès"):"Image invalide",
            "image" => $data->user()->url_photo
        ]);
	}
	
	public function store($data)
	{

		$token = Str::random(60);

		$user = Utilisateur::create([
			'nom_utilisateur' => $data->username,
			'nom' => $data->nom,
			'prenom' => $data->prenom,
			'email' => $data->email,
			'telephone' => $data->telephone,
			'date_de_creation' => now(),
			'password' => Hash::make($data->password),
			'api_token' => $token
		]);

		return response()->json([
			'status' => true,
			'api_token' => $token,
			'access_token' => $user->createToken("access_token")->plainTextToken,
			'id' => $user->id_utilisateur,
			'nom' => $user->nom,
			'prenom' => $user->prenom,
			'message' => trans("Inscription effectuée avec succès")
		]);
	}

	public function login($data){

		$user = Utilisateur::whereNomUtilisateur($data->username);

		if ($user->exists()) {
			$user = $user->first();

			$hashedPassword = $user->password;

			if (Hash::check($data->password, $hashedPassword)) {

				$token = $user->createToken("access_token");
				$api_token = $user->refreshToken();
				$user->update(['api_token' => $api_token]);

		    	return response()->json([
					'status' => true,
					'access_token' => $token->plainTextToken,
					'user' => $user,
					'message' => "Utilisateur authentifié",
				]);
			}
		}


		return response()->json([
			'status' => false,
			'message' => "identifiant ou mot de passe incorrect",
		]);
	}
}
 ?>