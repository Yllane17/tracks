<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 * 
 * @property int $id_user
 * @property int $id_role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Role $role
 * @property User $user
 *
 * @package App\Models
 */
class UserRole extends Model
{
	protected $table = 'user_role';
	public $incrementing = false;

	protected $casts = [
		'id_user' => 'int',
		'id_role' => 'int'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'id_role');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
