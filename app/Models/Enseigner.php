<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Enseigner
 * 
 * @property int $id_user
 * @property string $code_ec
 * @property string $type_cours
 * @property int $vol_attribue
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Ec $ec
 * @property User $user
 *
 * @package App\Models
 */
class Enseigner extends Model
{
	protected $table = 'enseigner';
	public $incrementing = false;

	protected $casts = [
		'id_user' => 'int',
		'vol_attribue' => 'int'
	];

	protected $fillable = [
		'vol_attribue'
	];

	public function ec()
	{
		return $this->belongsTo(Ec::class, 'code_ec');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
