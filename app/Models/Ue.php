<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ue
 * 
 * @property string $code_ue
 * @property string $libelle_ue
 * @property int $nbre_credit
 * @property string $type_ue
 * @property string $code_filiere
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Filiere $filiere
 * @property Collection|Ec[] $ecs
 *
 * @package App\Models
 */
class Ue extends Model
{
	protected $table = 'ue';
	protected $primaryKey = 'code_ue';
	public $incrementing = false;

	protected $casts = [
		'nbre_credit' => 'int'
	];

	protected $fillable = [
		'libelle_ue',
		'nbre_credit',
		'type_ue',
		'code_filiere'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'code_filiere');
	}

	public function ecs()
	{
		return $this->hasMany(Ec::class, 'code_ue');
	}
}
