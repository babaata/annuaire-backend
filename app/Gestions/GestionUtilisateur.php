<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur, Profil};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class GestionUtilisateur
{
	use SendsPasswordResetEmails;

	public function resetPassword($request)
	{
		$status = true;

        return response()->json([
            "status" => $status,
            'message' => $status ? "Réinitialisation du mot de passe réussie":"Email invalide"
        ]);
	}

	public function forgotPassword($data)
	{
		$status = true;

        return response()->json([
            "status" => $status,
            'message' => $status ? "Lien de réinitialisation du mot de passe envoyé à votre adresse e-mail":"Email invalide"
        ]);
	}

	public function updatePassword($data)
	{

		$status = false;

		if (Hash::check($data->old_password, $data->user()->password)) {
			$status = true;

		    $data->user()->update([
				'password' => Hash::make($data->new_password)
			]);
		}

		return response()->json([
            "status" => $status,
            'message' => $status ? "Le mot de passe a été changé avec succès":"Mot de passe invalide"
        ]);
	}

	public function update($data)
	{
		$data->user()->update([
			'nom' => $data->nom,
			'prenom' => $data->prenom,
			'email' => $data->email,
			'telephone' => $data->telephone,
			'date_de_modification' => now(),
		]);

		return response()->json([
            "status" => true,
            'message' => "Profil modifié avec succès",
            'user' => $data->user(),
        ]);
	}

	public function getBydId($user)
	{
		$user = Utilisateur::whereIdUtilisateur($user)
			->with('langues')
			->with(
				'profils.competences', 
				'profils.educations', 
				'profils.certifications',
				'profils.experienceProfessionnelles',
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
			->with('langues')
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
		$user = Utilisateur::create([
			'nom' => $data->nom,
			'prenom' => $data->prenom,
			'email' => $data->email,
			'telephone' => $data->telephone,
			'date_de_creation' => now(),
			'password' => Hash::make($data->password),
		]);

		return $this->login([
			'email' => $user->email,
			'password' => $data->password
		], true);
	}

	/**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

	public function login($data, $register = false){

		$credentials = [
			'email' => $register ? $data['email']:$data->email,
			'password' => $register ? $data['password']:$data->password
		];

		if (!$token = auth()->attempt($credentials)) {
            return response()->json([
            	'status' => false,
				'message' => "identifiant ou mot de passe incorrect"
            ]);
        }

        return $this->respondWithToken($token);
	}

	/**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('api')->logout();
        return response()->json([
        	'status' => true,
        	'message' => 'User successfully signed out'
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }
}
 ?>