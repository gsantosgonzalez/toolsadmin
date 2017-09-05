<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frecuency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'frecuencies';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Frecuency has many ContractTools.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contractTools()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = frecuency_id, localKey = id)
    	return $this->hasMany(ContractTool::class);
    }
}
