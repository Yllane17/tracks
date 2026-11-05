<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $idRole
 * @property string $libelle
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Permission[] $permissions
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	protected $primaryKey = 'idRole';

	protected $fillable = [
		'libelle'
	];

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'permission_role', 'idRole', 'idPermission')
					->withPivot('id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_role', 'id_role', 'id_user')
					->withTimestamps();
	}
}
