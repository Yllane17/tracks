<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * 
 * @property int $idPermission
 * @property string $libelle_permission
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Permission extends Model
{
	protected $table = 'permissions';
	protected $primaryKey = 'idPermission';

	protected $fillable = [
		'libelle_permission'
	];

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'permission_role', 'idPermission', 'idRole')
					->withPivot('id');
	}
}
