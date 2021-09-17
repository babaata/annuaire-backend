<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Competence
 * 
 * @property int $id_competence
 * @property string $nom
 * @property string $niveau
 * @property int $id_profil
 * 
 * @property Profil $profil
 *
 * @package App\Models
 */
class Competence extends Model
{
	protected $table = 'competence';
	protected $primaryKey = 'id_competence';
	public $timestamps = false;

	protected $casts = [
		'id_profil' => 'int'
	];

	protected $fillable = [
		'nom',
		'niveau',
		'id_profil'
	];

	public function profil()
	{
		return $this->belongsTo(Profil::class, 'id_profil');
	}
}
