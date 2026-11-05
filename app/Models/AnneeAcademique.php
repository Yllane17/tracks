<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnneeAcademique
 * 
 * @property int $id_anne
 * @property string $libelle_annee
 * @property Carbon $dateDebut
 * @property Carbon $dateFin
 * @property string $statut_academique
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Inscription[] $inscriptions
 * @property Collection|Semestre[] $semestres
 *
 * @package App\Models
 */
class AnneeAcademique extends Model
{
	protected $table = 'annee_academiques';
	protected $primaryKey = 'id_anne';

	protected $casts = [
		'dateDebut' => 'datetime',
		'dateFin' => 'datetime'
	];

	protected $fillable = [
		'libelle_annee',
		'dateDebut',
		'dateFin',
		'statut_academique'
	];

	public function inscriptions()
	{
		return $this->hasMany(Inscription::class, 'id_anne');
	}

	public function semestres()
	{
		return $this->hasMany(Semestre::class, 'id_anne');
	}
}
