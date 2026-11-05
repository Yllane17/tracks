<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Edt
 * 
 * @property int $id_Edt
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property string $statut_edt
 * @property int $idClasse
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Class $class
 * @property Collection|Seance[] $seances
 *
 * @package App\Models
 */
class Edt extends Model
{
	protected $table = 'edts';
	protected $primaryKey = 'id_Edt';

	protected $casts = [
		'date_debut' => 'datetime',
		'date_fin' => 'datetime',
		'idClasse' => 'int'
	];

	protected $fillable = [
		'date_debut',
		'date_fin',
		'statut_edt',
		'idClasse'
	];

	public function class()
	{
		return $this->belongsTo(Class::class, 'idClasse');
	}

	public function seances()
	{
		return $this->hasMany(Seance::class, 'id_Edt');
	}
}
