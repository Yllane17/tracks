<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Enseignement
 * 
 * @property int $id
 * @property int $id_user
 * @property int $idEc
 * @property string $type_cours
 * @property int $vol_attribue
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property MatiereEc $matiere_ec
 *
 * @package App\Models
 */
class Enseignement extends Model
{
	protected $table = 'enseignements';

	protected $casts = [
		'id_user' => 'int',
		'idEc' => 'int',
		'vol_attribue' => 'int'
	];

	protected $fillable = [
		'id_user',
		'idEc',
		'type_cours',
		'vol_attribue'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function matiere_ec()
	{
		return $this->belongsTo(MatiereEc::class, 'idEc');
	}
}
