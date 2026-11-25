<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tranche
 * 
 * @property int $id_tranche
 * @property Carbon $heure_debut
 * @property Carbon $heure_fin
 * @property string $libelle_tranche
 * @property int $duree_tranche
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Seance[] $seances
 *
 * @package App\Models
 */
class Tranche extends Model
{
	protected $table = 'tranche';
	protected $primaryKey = 'id_tranche';

	protected $casts = [
		'heure_debut' => 'datetime',
		'heure_fin' => 'datetime',
		'duree_tranche' => 'int'
	];

	protected $fillable = [
		'heure_debut',
		'heure_fin',
		'libelle_tranche',
		'duree_tranche'
	];

	public function seances()
	{
		return $this->hasMany(Seance::class, 'id_tranche');
	}
}
