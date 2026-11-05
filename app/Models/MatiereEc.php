<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MatiereEc
 * 
 * @property int $idEc
 * @property string $libelle
 * @property int $credit
 * @property int $vol_horaire
 * @property string|null $description
 * @property int $td
 * @property int $tp
 * @property int $cm
 * @property int $idUe
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ModuleUe $module_ue
 * @property Collection|Enseignement[] $enseignements
 * @property Collection|Seance[] $seances
 *
 * @package App\Models
 */
class MatiereEc extends Model
{
	protected $table = 'matiere_ecs';
	protected $primaryKey = 'idEc';

	protected $casts = [
		'credit' => 'int',
		'vol_horaire' => 'int',
		'td' => 'int',
		'tp' => 'int',
		'cm' => 'int',
		'idUe' => 'int'
	];

	protected $fillable = [
		'libelle',
		'credit',
		'vol_horaire',
		'description',
		'td',
		'tp',
		'cm',
		'idUe'
	];

	public function module_ue()
	{
		return $this->belongsTo(ModuleUe::class, 'idUe');
	}

	public function enseignements()
	{
		return $this->hasMany(Enseignement::class, 'idEc');
	}

	public function seances()
	{
		return $this->hasMany(Seance::class, 'idEc');
	}
}
