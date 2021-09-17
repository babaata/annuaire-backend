<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateur
 * 
 * @property int $id_utilisateur
 * @property string $nom_utilisateur
 * @property string $nom
 * @property string $prenom
 * @property Carbon $date_de_naissance
 * @property string $sexe
 * @property string $email
 * @property string|null $telephone
 * @property Carbon|null $date_de_creation
 * @property Carbon|null $date_de_modification
 * @property bool|null $statut
 * @property Carbon|null $date_de_desactivation
 * @property string|null $url_photo
 * @property string $password
 * 
 * @property Collection|Profil[] $profils
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Utilisateur extends Model
{
	protected $table = 'utilisateur';
	protected $primaryKey = 'id_utilisateur';
	public $timestamps = false;

	protected $casts = [
		'statut' => 'bool'
	];

	protected $dates = [
		'date_de_naissance',
		'date_de_creation',
		'date_de_modification',
		'date_de_desactivation'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nom_utilisateur',
		'nom',
		'prenom',
		'date_de_naissance',
		'sexe',
		'email',
		'telephone',
		'date_de_creation',
		'date_de_modification',
		'statut',
		'date_de_desactivation',
		'url_photo',
		'password'
	];

	public function profils()
	{
		return $this->hasMany(Profil::class, 'id_utilisateur');
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'utilisateur_role', 'id_utilisateur', 'id_role');
	}
}
