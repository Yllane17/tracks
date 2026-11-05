<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evenement
 * 
 * @property int $id_eve
 * @property string $libelle_eve
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|AppNotification[] $app_notifications
 *
 * @package App\Models
 */
class Evenement extends Model
{
	protected $table = 'evenements';
	protected $primaryKey = 'id_eve';

	protected $casts = [
		'date_debut' => 'datetime',
		'date_fin' => 'datetime'
	];

	protected $fillable = [
		'libelle_eve',
		'date_debut',
		'date_fin'
	];

	public function app_notifications()
	{
		return $this->hasMany(AppNotification::class, 'id_eve');
	}
}
