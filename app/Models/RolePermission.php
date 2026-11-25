<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RolePermission
 * 
 * @property int $id_role
 * @property int $id_permission
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Permission $permission
 * @property Role $role
 *
 * @package App\Models
 */
class RolePermission extends Model
{
	protected $table = 'role_permission';
	public $incrementing = false;

	protected $casts = [
		'id_role' => 'int',
		'id_permission' => 'int'
	];

	public function permission()
	{
		return $this->belongsTo(Permission::class, 'id_permission');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'id_role');
	}
}
