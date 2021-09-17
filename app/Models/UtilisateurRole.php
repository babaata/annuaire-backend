<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UtilisateurRole
 * 
 * @property int $id_utilisateur
 * @property int $id_role
 * 
 * @property Role $role
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class UtilisateurRole extends Model
{
	protected $table = 'utilisateur_role';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_utilisateur' => 'int',
		'id_role' => 'int'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'id_role');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
	}
}
