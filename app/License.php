<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'licenses';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['license_key'];

    /**
     * License belongs to Tool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tool()
    {
    	// belongsTo(RelatedModel, foreignKey = tool_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Tool::class);
    }

    /**
     * License belongs to Frecuency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function frecuency()
    {
    	// belongsTo(RelatedModel, foreignKey = frecuency_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Frecuency::class);
    }

    /**
     * License belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
    	// belongsTo(RelatedModel, foreignKey = currency_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Currency::class);
    }

    /**
     * License belongs to Paymethod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymethod()
    {
        // belongsTo(RelatedModel, foreignKey = paymethod_id, keyOnRelatedModel = id)
        return $this->belongsTo(Paymethod::class);
    }

    /**
     * License has many AssignLicense.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignLicenses()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = license_id, localKey = id)
        return $this->hasMany(AssignLicense::class);
    }

}
