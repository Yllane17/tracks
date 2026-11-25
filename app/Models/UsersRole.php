<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersRole
 * 
 * @property int $id_role
 * @property int $id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Role $role
 * @property User $user
 *
 * @package App\Models
 */
class UsersRole extends Model
{
	protected $table = 'users_role';
	public $incrementing = false;

	protected $casts = [
		'id_role' => 'int',
		'id_user' => 'int'
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
