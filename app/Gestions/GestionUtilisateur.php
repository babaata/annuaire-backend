<?php
namespace App\Gestions;
/**
 *
 */

use App\Models\{Utilisateur, Profil, UtilisateurLangue, Langue};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Mail\SendMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

class GestionUtilisateur
{
	use SendsPasswordResetEmails;

	public function getMe($data)
	{
		$user = $data->user()
			->with('profil.competences')
			->with('profil.experienceProfessionnelles')
			->with('profil.educations')
			->with('langues')->get()->find($data->user()->id_utilisateur);

		return response()->json([
            "status" => true,
            'user' => $user
        ]);
	}

	public function resetPassword($data)
	{
		$status = false;

		$message = "Email invalide";

		$user = Utilisateur::whereCodeSms($data->code);

		if ($user->exists()) {

			$user = $user->first();

			$from = Carbon::parse($user->date_code_sms);
			$to = Carbon::parse(now());

			$minute = $to->diffInMinutes($from);

			if ($minute < 60 AND $data->code == $user->code_sms) {
				$user->update([
					'password' => Hash::make($data->password),
					'code_sms' => null,
					'date_code_sms' => null
				]);

				$message = "Réinitialisation du mot de passe réussie";

				$status = true;
			}else{
				$message = "Code de réinitialisation invalide";
			}
		}

        return response()->json([
            "status" => $status,
            'message' => $message
        ]);
	}

	public function forgotPassword($data)
	{
		$status = false;

		$code = generate_otp();
		$user = Utilisateur::whereEmail($data->email);
		if ($user->exists()) {

			$user->first()->update([
				'code_sms' => $code,
				'date_code_sms' => now()
			]);

			try {
				Mail::to($data->email)->send(new SendMail($data->email, $code));
				$status = true;
			} catch (\Swift_TransportException $e) {
				$status = false;
			}
		}

        return response()->json([
            "status" => $status,
            'message' => $status ? "Le code de réinitialisation du mot de passe envoyé à votre adresse email":"Email invalide"
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
			'sexe' => $data->sexe,
			'telephone' => $data->telephone,
			'date_de_modification' => now(),
		]);

		if ($data->has('langues')) {
			$this->setLangues($data);
		}

		return response()->json([
            "status" => true,
            'message' => "Profil modifié avec succès",
            'user' => $data->user(),
        ]);
	}

	public function setLangues($data)
	{
		foreach ($data->langues as $key => $langue) {
			if (Langue::find($langue)){
				UtilisateurLangue::firstOrCreate([
					'id_langue' => $langue,
					'id_utilisateur' => $data->user()->id_utilisateur
				]);
			}
		}
	}

	public function getBydId($user)
	{
		$user = Utilisateur::whereNomUtilisateur($user)
			->with('langues')
			->with(
				'profil.competences',
				'profil.educations',
				'profil.certifications',
				'profil.experienceProfessionnelles',
			);

		return response()->json([
            "status" => $user->exists(),
            'user' => $user->first(),
            'message' => $user->exists() ? null:"Aucun utilisateur de ce nom"
        ]);
	}

	public function allUsers($data)
	{
		$users = Utilisateur::orderBy('date_de_creation', 'DESC')
			->with('profil.competences')
			->with('profil.experienceProfessionnelles')
			->with('profil.educations')
			->with('langues');

		if ($data->has('competence')) {
			$terme = $data->competence;
			$users = $users->whereIn('id_utilisateur', function ($query) use ($terme){
				$query->from('profil')->whereIn('id_profil', function ($query) use ($terme){
					$query->from('competence')->where('nom', 'LIKE', "%".$terme."%")
					->select('id_profil')->get();
				})->select('id_utilisateur')->get();
			});
		}

		if ($data->has('profil')) {
			$terme = $data->profil;
			$users = $users->where(function ($query) use ($terme){
				$query->orWhere('nom', 'LIKE', "%".$terme."%")
				->orWhere('prenom', 'LIKE', "%".$terme."%")->get();
			});
		}

		return response()->json([
            "status" => true,
            'users' => $users->limit(8)->get()
        ]);
	}

	public function userPagination($data)
	{
		$users = Utilisateur::orderBy('date_de_creation', 'DESC')
			->with('profil.competences')
			->with('profil.experienceProfessionnelles')
			->with('profil.educations')
			->with('langues');

		$size = $data->has('size') ? $data->size:15;

		return response()->json([
            "status" => true,
            'users' => $users->paginate($size)
        ]);
	}

	public function searchUser($data)
	{
        $req= $data->request;

		$competence = ($data->has('competences') AND !empty($data->competences)) ? $req->get('competences') : "@#&*";
		$profil = ($data->has('profession') AND !empty($data->profession)) ? $req->get('profession') : "@#&*";
		$pays = ($data->has('pays') AND !empty($data->pays)) ? $req->get('pays') : "@#&*";

		$users = Utilisateur::whereIn('id_utilisateur', function ($query) use ($competence){
			$query->from('profil')->whereIn('id_profil', function ($query) use ($competence){
				$query->from('competence')->where('nom', 'LIKE', $competence."%")->select('id_profil')->get();
			})->select('id_utilisateur')->get();
		})->orWhereIn('id_utilisateur', function ($query) use ($profil){
			$query->from('profil')->where('titre', 'LIKE', $profil."%")->select('id_utilisateur')->get();
		})->orWhereIn('id_pays', function ($query) use ($pays){
			$query->from('pays')->where('nom', 'LIKE', $pays."%")->select('id_pays')->get();
		})->orderBy('date_de_creation', 'DESC')
		->with('profil.competences')
		->with('profil.experienceProfessionnelles')
		->with('profil.educations')
		->with('langues')->get();

		return response()->json([
            "status" => true,
            'users' => $users
        ]);
	}

	public function saveUserPicture($data)
	{
		$status = false;
		$image = null;
		if ($status = $data->file('image')->isValid()) {

            //store file into users pictures folder
            $name = (string) Str::uuid();
            $extension = $data->image->extension();
            $path = $data->image->storeAs('public/users', "$name.$extension", 'local');

            $data->user()->update([
            	'url_photo' => asset(Storage::url($path))
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
			'url_photo' => asset('public/default.jpg')
		]);

		$username = $this->createUserName($user->nom, $user->prenom);

		$user->update(['nom_utilisateur' => $username]);

		return $this->login([
			'email' => $user->email,
			'password' => $data->password
		], true);
	}

	public function createUserName($nom, $prenom)
	{
		$count = Utilisateur::count()+1;
		return Str::slug("$nom $prenom $count");
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
        	//'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 43200,
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
