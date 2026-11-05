<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inscription
 *
 * @property int $id
 * @property int $id_user
 * @property int $idClasse
 * @property int $id_anne
 * @property string $date_inscription
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property AnneeAcademique $annee_academique
 * @property User $user
 * @property Classe $classe
 *
 * @package App\Models
 */
class Inscription extends Model
{
	protected $table = 'inscriptions';

	protected $casts = [
		'id_user' => 'int',
		'idClasse' => 'int',
		'id_anne' => 'int'
	];

	protected $fillable = [
		'id_user',
		'idClasse',
		'id_anne',
		'date_inscription'
	];

	public function annee_academique()
	{
		return $this->belongsTo(AnneeAcademique::class, 'id_anne');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function classe()
	{
		return $this->belongsTo('App\\Models\\Classe', 'idClasse');
	}
}
