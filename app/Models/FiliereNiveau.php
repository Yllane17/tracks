<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FiliereNiveau
 * 
 * @property int $idFiliere
 * @property int $idNiveau
 * 
 * @property Filiere $filiere
 * @property Niveau $niveau
 *
 * @package App\Models
 */
class FiliereNiveau extends Model
{
	protected $table = 'filiere_niveau';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idFiliere' => 'int',
		'idNiveau' => 'int'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'idFiliere');
	}

	public function niveau()
	{
		return $this->belongsTo(Niveau::class, 'idNiveau');
	}
}
