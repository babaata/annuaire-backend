<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleDroit
 * 
 * @property int $id_droit
 * @property int $id_role
 * 
 * @property Droit $droit
 * @property Role $role
 *
 * @package App\Models
 */
class RoleDroit extends Model
{
	protected $table = 'role_droit';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_droit' => 'int',
		'id_role' => 'int'
	];

	public function droit()
	{
		return $this->belongsTo(Droit::class, 'id_droit');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'id_role');
	}
}
