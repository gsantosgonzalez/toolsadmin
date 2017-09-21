<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignLicense extends Model
{
     
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'assign_licenses';

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['activation-date', 'deactivation-date'];

	/**
	 * AssignLicense belongs to License.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function license()
	{
		// belongsTo(RelatedModel, foreignKey = license_id, keyOnRelatedModel = id)
		return $this->belongsTo(License::class);
	}

	/**
	 * AssignLicense belongs to Area.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function area()
	{
		// belongsTo(RelatedModel, foreignKey = area_id, keyOnRelatedModel = id)
		return $this->belongsTo(Area::class);
	}

	/**
	 * AssignLicense belongs to Computer.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function computer()
	{
		// belongsTo(RelatedModel, foreignKey = computer_id, keyOnRelatedModel = id)
		return $this->belongsTo(Computer::class);
	}

}
