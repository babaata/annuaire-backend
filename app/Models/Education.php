<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Education
 * 
 * @property int $id_education
 * @property string $ecole
 * @property string|null $pays
 * @property string|null $ville
 * @property string $diplome
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property string $description
 * @property int $id_profil
 * 
 * @property Profil $profil
 * @property Collection|Media[] $media
 *
 * @package App\Models
 */
class Education extends Model
{
	protected $table = 'education';
	protected $primaryKey = 'id_education';
	public $timestamps = false;

	protected $casts = [
		'id_profil' => 'int'
	];

	protected $dates = [
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'ecole',
		'pays',
		'ville',
		'diplome',
		'date_debut',
		'date_fin',
		'description',
		'id_profil'
	];

	public function profil()
	{
		return $this->belongsTo(Profil::class, 'id_profil');
	}

	public function media()
	{
		return $this->hasMany(Media::class, 'id_education');
	}
}
