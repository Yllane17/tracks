<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Salle
 * 
 * @property int $idSalle
 * @property string $libelle_salle
 * @property int $nbre_place
 * @property string $batiment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Seance[] $seances
 *
 * @package App\Models
 */
class Salle extends Model
{
	protected $table = 'salles';
	protected $primaryKey = 'idSalle';

	protected $casts = [
		'nbre_place' => 'int'
	];

	protected $fillable = [
		'libelle_salle',
		'nbre_place',
		'batiment'
	];

	public function seances()
	{
		return $this->hasMany(Seance::class, 'idSalle');
	}
}
