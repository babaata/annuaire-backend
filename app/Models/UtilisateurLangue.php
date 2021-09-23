<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
	protected $primaryKey = ['id_utilisateur', 'id_langue'];
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_utilisateur' => 'int',
		'id_langue' => 'int'
	];

	protected $fillable = [
		'niveau',
		'id_langue',
		'id_utilisateur'
	];

	public function langue()
	{
		return $this->belongsTo(Langue::class, 'id_langue');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
	}

	protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('id_utilisateur', '=', $this->getAttribute('id_utilisateur'))
            ->where('id_langue', '=', $this->getAttribute('id_langue'));
        return $query;
    }
}
