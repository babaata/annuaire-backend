<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UtilisateurLangue
 * 
 * @property string|null $niveau
 * @property int $id_utilisateur
 * @property int $id_langue
 * 
 * @property Langue $langue
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class UtilisateurLangue extends Model
{
	protected $table = 'utilisateur_langue';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_utilisateur' => 'int',
		'id_langue' => 'int'
	];

	protected $fillable = [
		'niveau'
	];

	public function langue()
	{
		return $this->belongsTo(Langue::class, 'id_langue');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
	}
}
