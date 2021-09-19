<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Referent
 * 
 * @property int $id_referent
 * @property string $nom
 * @property string $prenom
 * @property string $poste
 * @property string $email
 * @property string|null $telephone
 * @property int $id_experience_professionnelle
 * 
 * @property ExperienceProfessionnelle $experience_professionnelle
 *
 * @package App\Models
 */
class Referent extends Model
{
	protected $table = 'referent';
	protected $primaryKey = 'id_referent';
	public $timestamps = false;

	protected $casts = [
		'id_experience_professionnelle' => 'int'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'poste',
		'email',
		'telephone',
		'id_experience_professionnelle'
	];

	public function experienceProfessionnelle()
	{
		return $this->belongsTo(ExperienceProfessionnelle::class, 'id_experience_professionnelle');
	}
}
