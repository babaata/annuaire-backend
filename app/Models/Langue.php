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
 * @property int $id_utilisateur
 * 
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Langue extends Model
{
	protected $table = 'langue';
	protected $primaryKey = 'id_langue';
	public $timestamps = false;

	protected $casts = [
		'id_utilisateur' => 'int'
	];

	protected $fillable = [
		'nom',
		'niveau',
		'id_utilisateur'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
	}
}
