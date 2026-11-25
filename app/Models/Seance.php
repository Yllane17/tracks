<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Seance
 * 
 * @property int $id_prog
 * @property Carbon $date
 * @property string $libelle_prog
 * @property string $statut
 * @property int $id_Edt
 * @property int $idSalle
 * @property int $idTranche
 * @property int $idEc
 * @property int $id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Edt $edt
 * @property User $user
 * @property MatiereEc $matiere_ec
 * @property Salle $salle
 * @property TrancheHoraire $tranche_horaire
 *
 * @package App\Models
 */
class Seance extends Model
{
	protected $table = 'seance';
	protected $primaryKey = 'id_prog';

	protected $casts = [
		'date' => 'datetime',
		'id_Edt' => 'int',
		'idSalle' => 'int',
		'idTranche' => 'int',
		'idEc' => 'int',
		'id_user' => 'int'
	];

	protected $fillable = [
		'date',
		'libelle_prog',
		'statut',
		'id_Edt',
		'idSalle',
		'idTranche',
		'idEc',
		'id_user'
	];

	public function edt()
	{
		return $this->belongsTo(Edt::class, 'id_Edt');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function matiere_ec()
	{
		return $this->belongsTo(MatiereEc::class, 'idEc');
	}

	public function salle()
	{
		return $this->belongsTo(Salle::class, 'idSalle');
	}

	public function tranche_horaire()
	{
		return $this->belongsTo(TrancheHoraire::class, 'idTranche');
	}
}
