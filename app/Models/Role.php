<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id_role
 * @property string $nom
 * @property string|null $description
 * @property bool|null $statut
 * 
 * @property Collection|Droit[] $droits
 * @property Collection|Utilisateur[] $utilisateurs
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'role';
	protected $primaryKey = 'id_role';
	public $timestamps = false;

	protected $casts = [
		'statut' => 'bool'
	];

	protected $fillable = [
		'nom',
		'description',
		'statut'
	];

	public function droits()
	{
		return $this->belongsToMany(Droit::class, 'role_droit', 'id_role', 'id_droit');
	}

	public function utilisateurs()
	{
		return $this->belongsToMany(Utilisateur::class, 'utilisateur_role', 'id_role', 'id_utilisateur');
	}
}
