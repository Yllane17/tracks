<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ec
 * 
 * @property string $code_ec
 * @property string $libelle_ec
 * @property int $nbre_credit
 * @property int $nbre_heure
 * @property string|null $description_ec
 * @property int $heure_tp
 * @property int $heure_td
 * @property int $heure_tcm
 * @property string $code_ue
 * @property string $code_filiere
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Filiere $filiere
 * @property Ue $ue
 * @property Collection|Enseigner[] $enseigners
 * @property Collection|Seance[] $seances
 *
 * @package App\Models
 */
class Ec extends Model
{
	protected $table = 'ec';
	protected $primaryKey = 'code_ec';
	public $incrementing = false;

	protected $casts = [
		'nbre_credit' => 'int',
		'nbre_heure' => 'int',
		'heure_tp' => 'int',
		'heure_td' => 'int',
		'heure_tcm' => 'int'
	];

	protected $fillable = [
		'libelle_ec',
		'nbre_credit',
		'nbre_heure',
		'description_ec',
		'heure_tp',
		'heure_td',
		'heure_tcm',
		'code_ue',
		'code_filiere'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'code_filiere');
	}

	public function ue()
	{
		return $this->belongsTo(Ue::class, 'code_ue');
	}

	public function enseigners()
	{
		return $this->hasMany(Enseigner::class, 'code_ec');
	}

	public function seances()
	{
		return $this->hasMany(Seance::class, 'code_ec');
	}
}
