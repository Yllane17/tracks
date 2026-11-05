<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionRole
 * 
 * @property int $id
 * @property int $idRole
 * @property int $idPermission
 * 
 * @property Permission $permission
 * @property Role $role
 *
 * @package App\Models
 */
class PermissionRole extends Model
{
	protected $table = 'permission_role';
	public $timestamps = false;

	protected $casts = [
		'idRole' => 'int',
		'idPermission' => 'int'
	];

	protected $fillable = [
		'idRole',
		'idPermission'
	];

	public function permission()
	{
		return $this->belongsTo(Permission::class, 'idPermission');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'idRole');
	}
}
