<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Certification
 * 
 * @property int $id_certification
 * @property string $nom
 * @property string $organisme_delivrance
 * @property string|null $level
 * @property Carbon|null $date_certification
 * @property string|null $url
 * @property int $id_profil
 * 
 * @property Profil $profil
 * @property Collection|Media[] $media
 *
 * @package App\Models
 */
class Certification extends Model
{
	protected $table = 'certification';
	protected $primaryKey = 'id_certification';
	public $timestamps = false;

	protected $casts = [
		'id_profil' => 'int'
	];

	protected $dates = [
		'date_certification'
	];

	protected $fillable = [
		'nom',
		'organisme_delivrance',
		'level',
		'date_certification',
		'url',
		'id_profil'
	];

	public function profil()
	{
		return $this->belongsTo(Profil::class, 'id_profil');
	}

	public function media()
	{
		return $this->hasMany(Media::class, 'id_certification');
	}
}
