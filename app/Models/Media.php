<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Media
 * 
 * @property int $id_media
 * @property string $nom
 * @property string $description
 * @property string $url
 * @property int|null $id_experience_professionnelle
 * @property int|null $id_certification
 * @property int|null $id_education
 * 
 * @property Certification|null $certification
 * @property Education|null $education
 * @property ExperienceProfessionnelle|null $experience_professionnelle
 *
 * @package App\Models
 */
class Media extends Model
{
	protected $table = 'media';
	protected $primaryKey = 'id_media';
	public $timestamps = false;

	protected $casts = [
		'id_experience_professionnelle' => 'int',
		'id_certification' => 'int',
		'id_education' => 'int'
	];

	protected $fillable = [
		'nom',
		'description',
		'url',
		'id_experience_professionnelle',
		'id_certification',
		'id_education'
	];

	public function certification()
	{
		return $this->belongsTo(Certification::class, 'id_certification');
	}

	public function education()
	{
		return $this->belongsTo(Education::class, 'id_education');
	}

	public function experience_professionnelle()
	{
		return $this->belongsTo(ExperienceProfessionnelle::class, 'id_experience_professionnelle');
	}
}
