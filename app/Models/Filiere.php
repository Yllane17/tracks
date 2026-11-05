<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Filiere
 * 
 * @property int $idFiliere
 * @property string $nomFiliere
 * @property string $code_filiere
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Departement[] $departements
 * @property Collection|Niveau[] $niveaux
 * @property Collection|ModuleUe[] $module_ues
 *
 * @package App\Models
 */
class Filiere extends Model
{
	protected $table = 'filieres';
	protected $primaryKey = 'idFiliere';

	protected $fillable = [
		'nomFiliere',
		'code_filiere'
	];

	public function departements()
	{
		return $this->hasMany(Departement::class, 'idFiliere');
	}

	public function niveaux()
	{
		return $this->belongsToMany(Niveau::class, 'filiere_niveau', 'idFiliere', 'idNiveau');
	}

	public function module_ues()
	{
		return $this->hasMany(ModuleUe::class, 'idFiliere');
	}
}
