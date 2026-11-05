<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationUser
 * 
 * @property int $id_user
 * @property int $id_notif
 * 
 * @property AppNotification $app_notification
 * @property User $user
 *
 * @package App\Models
 */
class NotificationUser extends Model
{
	protected $table = 'notification_user';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_user' => 'int',
		'id_notif' => 'int'
	];

	public function app_notification()
	{
		return $this->belongsTo(AppNotification::class, 'id_notif');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
