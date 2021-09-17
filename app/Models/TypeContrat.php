<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeContrat
 * 
 * @property int $id_type_contrat
 * @property string $nom
 * @property string|null $slug
 * 
 * @property Collection|ExperienceProfessionnelle[] $experience_professionnelles
 *
 * @package App\Models
 */
class TypeContrat extends Model
{
	protected $table = 'type_contrat';
	protected $primaryKey = 'id_type_contrat';
	public $timestamps = false;

	protected $fillable = [
		'nom',
		'slug'
	];

	public function experience_professionnelles()
	{
		return $this->hasMany(ExperienceProfessionnelle::class, 'id_type_contrat');
	}
}
