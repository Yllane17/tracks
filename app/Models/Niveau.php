<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Niveau
 *
 * @property int $id_niveau
 * @property string $libelle_niveau
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Classe[] $classes
 * @property Collection|Filiere[] $filieres
 * @property Collection|ModuleUe[] $module_ues
 *
 * @package App\Models
 */
class Niveau extends Model
{
	protected $table = 'niveaux';
	protected $primaryKey = 'id_niveau';

	protected $fillable = [
		'libelle_niveau'
	];

	public function classes()
	{
		return $this->hasMany(Classe::class, 'id_niveau');
	}

	public function filieres()
	{
		return $this->belongsToMany(Filiere::class, 'filiere_niveau', 'idNiveau', 'idFiliere');
	}

	public function module_ues()
	{
		return $this->hasMany(ModuleUe::class, 'id_niveau');
	}
}
