<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Salle
 * 
 * @property int $id_salle
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
	protected $table = 'salle';
	protected $primaryKey = 'id_salle';

	protected $casts = [
		'nbre_place' => 'int'
	];

	protected $fillable = [
		'libelle_salle',
		'nbre_place',
		'batiment'
	];

	public function seances(): HasMany
	{
		return $this->hasMany(Seance::class, 'id_salle');
	}
}
