<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profil
 * 
 * @property int $id_profil
 * @property string $titre
 * @property string $resume
 * @property int $id_utilisateur
 * 
 * @property Utilisateur $utilisateur
 * @property Collection|Certification[] $certifications
 * @property Collection|Competence[] $competences
 * @property Collection|Education[] $education
 * @property Collection|ExperienceProfessionnelle[] $experience_professionnelles
 * @property Collection|Langue[] $langues
 *
 * @package App\Models
 */
class Profil extends Model
{
	protected $table = 'profil';
	protected $primaryKey = 'id_profil';
	public $timestamps = false;

	protected $casts = [
		'id_utilisateur' => 'int'
	];

	protected $fillable = [
		'titre',
		'resume',
		'id_utilisateur'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
	}

	public function certifications()
	{
		return $this->hasMany(Certification::class, 'id_profil');
	}

	public function competences()
	{
		return $this->hasMany(Competence::class, 'id_profil');
	}

	public function educations()
	{
		return $this->hasMany(Education::class, 'id_profil');
	}

	public function experienceProfessionnelles()
	{
		return $this->hasMany(ExperienceProfessionnelle::class, 'id_profil');
	}

	public function langues()
	{
		return $this->hasMany(Langue::class, 'id_profil');
	}
}
