<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departement
 * 
 * @property int $id_departement
 * @property string $nom_departement
 * @property int|null $idFiliere
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Filiere|null $filiere
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Departement extends Model
{
	protected $table = 'departement';
	protected $primaryKey = 'id_departement';

	protected $casts = [
		'idFiliere' => 'int'
	];

	protected $fillable = [
		'nom_departement',
		'idFiliere'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'idFiliere');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'id_departement');
	}
}
