<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Droit
 * 
 * @property int $id_droit
 * @property string $nom
 * @property string|null $description
 * @property bool|null $statut
 * 
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Droit extends Model
{
	protected $table = 'droit';
	protected $primaryKey = 'id_droit';
	public $timestamps = false;

	protected $casts = [
		'statut' => 'bool'
	];

	protected $fillable = [
		'nom',
		'description',
		'statut'
	];

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'role_droit', 'id_droit', 'id_role');
	}
}
