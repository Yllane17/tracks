<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModuleUe
 *
 * @property int $idUe
 * @property string $libelle_ue
 * @property int $nbre_credit
 * @property string $type_ue
 * @property int $id_sem
 * @property int|null $idFiliere
 * @property int|null $id_niveau
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Niveau|null $niveau
 * @property Semestre $semestre
 * @property Filiere|null $filiere
 * @property Collection|MatiereEc[] $matiere_ecs
 *
 * @package App\Models
 */
class ModuleUe extends Model
{
	protected $table = 'module_ues';
	protected $primaryKey = 'idUe';

	protected $casts = [
		'nbre_credit' => 'int',
		'id_sem' => 'int',
		'idFiliere' => 'int',
		'id_niveau' => 'int'
	];

	protected $fillable = [
        'idUe',
		'libelle_ue',
		'nbre_credit',
		'type_ue',
		'id_sem',
		'idFiliere',
		'id_niveau'
	];

	public function niveau()
	{
		return $this->belongsTo(Niveau::class, 'id_niveau');
	}

	public function semestre()
	{
		return $this->belongsTo(Semestre::class, 'id_sem');
	}

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'idFiliere');
	}

	public function matiere_ecs()
	{
		return $this->hasMany(MatiereEc::class, 'idUe');
	}
}
