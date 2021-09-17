<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Langue
 * 
 * @property int $id_langue
 * @property string $nom
 * @property string|null $niveau
 * @property string|null $slug
 * @property int $id_profil
 * 
 * @property Profil $profil
 *
 * @package App\Models
 */
class Langue extends Model
{
	protected $table = 'langue';
	protected $primaryKey = 'id_langue';
	public $timestamps = false;

	protected $casts = [
		'id_profil' => 'int'
	];

	protected $fillable = [
		'nom',
		'niveau',
		'slug',
		'id_profil'
	];

	public function profil()
	{
		return $this->belongsTo(Profil::class, 'id_profil');
	}
}
