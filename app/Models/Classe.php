<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Classe
 * 
 * @property string $code_classe
 * @property int $nb_etudiant
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
class Classe extends Model
{
	protected $table = 'classe';
	protected $primaryKey = 'code_classe';
	public $incrementing = false;

	protected $casts = [
		'nb_etudiant' => 'int',
		'id_niveau' => 'int'
	];

	protected $fillable = [
		'nb_etudiant',
		'id_niveau'
	];

	public function niveau()
	{
		return $this->belongsTo(Niveau::class, 'id_niveau');
	}

	public function edts()
	{
		return $this->hasMany(Edt::class, 'code_classe');
	}

	public function inscriptions()
	{
		return $this->hasMany(Inscription::class, 'code_classe');
	}
}
