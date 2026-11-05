<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id_user
 * @property string $name_user
 * @property string|null $last_name_user
 * @property string $email
 * @property string $matricule
 * @property string $phone_number
 * @property Carbon $date_of_birth
 * @property string $sexe
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int $id_departement
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departement $departement
 * @property Collection|Enseignement[] $enseignements
 * @property Collection|Inscription[] $inscriptions
 * @property Collection|NotificationUser[] $notification_users
 * @property Collection|Seance[] $seances
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'id_user';

	protected $casts = [
		'date_of_birth' => 'datetime',
		'email_verified_at' => 'datetime',
		'id_departement' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name_user',
		'last_name_user',
		'email',
		'matricule',
		'phone_number',
		'date_of_birth',
		'sexe',
		'email_verified_at',
		'password',
		'remember_token',
		'id_departement'
	];

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'id_departement');
	}

	public function enseignements()
	{
		return $this->hasMany(Enseignement::class, 'id_user');
	}

	public function inscriptions()
	{
		return $this->hasMany(Inscription::class, 'id_user');
	}

	public function notification_users()
	{
		return $this->hasMany(NotificationUser::class, 'id_user');
	}

	public function seances()
	{
		return $this->hasMany(Seance::class, 'id_user');
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'user_role', 'id_user', 'id_role')
					->withTimestamps();
	}
}
