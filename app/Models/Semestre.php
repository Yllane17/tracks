<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Semestre
 * 
 * @property int $id_sem
 * @property int $nbre_sem
 * @property int $id_anne
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnneeAcademique $annee_academique
 * @property Collection|ModuleUe[] $module_ues
 *
 * @package App\Models
 */
class Semestre extends Model
{
	protected $table = 'semestres';
	protected $primaryKey = 'id_sem';

	protected $casts = [
		'nbre_sem' => 'int',
		'id_anne' => 'int'
	];

	protected $fillable = [
		'nbre_sem',
		'id_anne'
	];

	public function annee_academique()
	{
		return $this->belongsTo(AnneeAcademique::class, 'id_anne');
	}

	public function module_ues()
	{
		return $this->hasMany(ModuleUe::class, 'id_sem');
	}
}
