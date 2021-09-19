<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Adresse
 * 
 * @property int $id_adresse
 * @property string $pays
 * @property string $ville
 * @property string|null $rue
 * @property string|null $zip
 *
 * @package App\Models
 */
class Adresse extends Model
{
	protected $table = 'adresse';
	protected $primaryKey = 'id_adresse';
	public $timestamps = false;

	protected $fillable = [
		'pays',
		'ville',
		'rue',
		'zip'
	];
}
