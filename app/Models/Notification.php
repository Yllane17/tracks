<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * 
 * @property int $id_notification
 * @property string $libelle_notification
 * @property string $description_notification
 * @property string $motif_notification
 * @property Carbon $date_notification
 * @property Carbon $heure
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notification';
	protected $primaryKey = 'id_notification';

	protected $casts = [
		'date_notification' => 'datetime',
		'heure' => 'datetime'
	];

	protected $fillable = [
		'libelle_notification',
		'description_notification',
		'motif_notification',
		'date_notification',
		'heure'
	];
}
