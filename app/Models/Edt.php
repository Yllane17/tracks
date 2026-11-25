<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Edt
 *
 * @property int $id_edt
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property string $statut
 * @property string $code_classe
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Classe $classe
 * @property Collection|Seance[] $seances
 *
 * @package App\Models
 */
class Edt extends Model
{
	protected $table = 'edt';
	protected $primaryKey = 'id_edt';

	protected $casts = [
		'date_debut' => 'date',
		'date_fin' => 'date'
	];

	protected $fillable = [
		'date_debut',
		'date_fin',
		'statut',
		'code_classe'
	];

	public function classe(): BelongsTo
	{
		return $this->belongsTo(Classe::class, 'code_classe', 'code_classe');
	}

	public function seances(): HasMany
	{
		return $this->hasMany(Seance::class, 'id_edt');
	}
}
