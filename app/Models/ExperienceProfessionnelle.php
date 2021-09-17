<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExperienceProfessionnelle
 * 
 * @property int $id_experience_professionnelle
 * @property string $entreprise
 * @property string $intitule_poste
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property string $description
 * @property int $id_profil
 * @property int $id_type_contrat
 * 
 * @property Profil $profil
 * @property TypeContrat $type_contrat
 * @property Collection|Media[] $media
 * @property Collection|Referent[] $referents
 *
 * @package App\Models
 */
class ExperienceProfessionnelle extends Model
{
	protected $table = 'experience_professionnelle';
	protected $primaryKey = 'id_experience_professionnelle';
	public $timestamps = false;

	protected $casts = [
		'id_profil' => 'int',
		'id_type_contrat' => 'int'
	];

	protected $dates = [
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'entreprise',
		'intitule_poste',
		'date_debut',
		'date_fin',
		'description',
		'id_profil',
		'id_type_contrat'
	];

	public function profil()
	{
		return $this->belongsTo(Profil::class, 'id_profil');
	}

	public function type_contrat()
	{
		return $this->belongsTo(TypeContrat::class, 'id_type_contrat');
	}

	public function media()
	{
		return $this->hasMany(Media::class, 'id_experience_professionnelle');
	}

	public function referents()
	{
		return $this->hasMany(Referent::class, 'id_experience_professionnelle');
	}
}
