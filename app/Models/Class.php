<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Class
 * 
 * @property int $idClasse
 * @property string $code_classe
 * @property int $effectif
 * @property int $id_niveau
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Niveau $niveau
 * @property Collection|Edt[] $edts
 * @property Collection|Inscription[] $inscriptions
 *
 * @package App\Models
 */
class Class extends Model
{
	protected $table = 'classes';
	protected $primaryKey = 'idClasse';

	protected $casts = [
		'effectif' => 'int',
		'id_niveau' => 'int'
	];

	protected $fillable = [
		'code_classe',
		'effectif',
		'id_niveau'
	];

	public function niveau()
	{
		return $this->belongsTo(Niveau::class, 'id_niveau');
	}

	public function edts()
	{
		return $this->hasMany(Edt::class, 'idClasse');
	}

	public function inscriptions()
	{
		return $this->hasMany(Inscription::class, 'idClasse');
	}
}
