<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppNotification
 * 
 * @property int $id_notif
 * @property string $description
 * @property string $motif
 * @property Carbon $date
 * @property Carbon $heure
 * @property int|null $id_eve
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Evenement|null $evenement
 * @property Collection|NotificationUser[] $notification_users
 *
 * @package App\Models
 */
class AppNotification extends Model
{
	protected $table = 'app_notifications';
	protected $primaryKey = 'id_notif';

	protected $casts = [
		'date' => 'datetime',
		'heure' => 'datetime',
		'id_eve' => 'int'
	];

	protected $fillable = [
		'description',
		'motif',
		'date',
		'heure',
		'id_eve'
	];

	public function evenement()
	{
		return $this->belongsTo(Evenement::class, 'id_eve');
	}

	public function notification_users()
	{
		return $this->hasMany(NotificationUser::class, 'id_notif');
	}
}
