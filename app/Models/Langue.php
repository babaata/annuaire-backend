<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Langue
 * 
 * @property int $id_langue
 * @property string $nom
 * 
 * @property Collection|Utilisateur[] $utilisateurs
 *
 * @package App\Models
 */
class Langue extends Model
{
	protected $table = 'langue';
	protected $primaryKey = 'id_langue';
	public $timestamps = false;

	protected $fillable = [
		'nom'
	];

	public function utilisateurs()
	{
		return $this->belongsToMany(Utilisateur::class, 'utilisateur_langue', 'id_langue', 'id_utilisateur')
					->withPivot('niveau');
	}
}
