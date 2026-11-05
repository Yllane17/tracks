<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrancheHoraire
 * 
 * @property int $idTranche
 * @property Carbon $debut
 * @property Carbon $fin
 * @property string $libelle_tranche
 * @property Carbon $duree
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Seance[] $seances
 *
 * @package App\Models
 */
class TrancheHoraire extends Model
{
	protected $table = 'tranche_horaires';
	protected $primaryKey = 'idTranche';

	protected $casts = [
		'debut' => 'datetime',
		'fin' => 'datetime',
		'duree' => 'datetime'
	];

	protected $fillable = [
		'debut',
		'fin',
		'libelle_tranche',
		'duree'
	];

	public function seances()
	{
		return $this->hasMany(Seance::class, 'idTranche');
	}
}
