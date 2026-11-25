<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Inscription
 * 
 * @property int $id_inscription
 * @property int $id_user
 * @property string $code_classe
 * @property int $id_annee
 * @property Carbon $date_inscription
 * @property string $statut_inscription
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnneeAcademique $annee_academique
 * @property User $user
 * @property Classe $classe
 *
 * @package App\Models
 */
class Inscription extends Model
{
	protected $table = 'inscription';
	protected $primaryKey = 'id_inscription';

	protected $casts = [
		'id_user' => 'int',
		'id_annee' => 'int',
		'date_inscription' => 'date'
	];

	protected $fillable = [
		'id_user',
		'code_classe',
		'id_annee',
		'date_inscription',
		'statut_inscription'
	];

	public function annee_academique(): BelongsTo
	{
		return $this->belongsTo(AnneeAcademique::class, 'id_annee', 'id_annee');
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'id_user', 'id_user');
	}

	public function classe(): BelongsTo
	{
		return $this->belongsTo(Classe::class, 'code_classe', 'code_classe');
	}
}
