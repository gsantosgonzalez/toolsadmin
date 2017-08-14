<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'types';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['type_name'];

    /**
     * Type has many Tools.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tools()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = type_id, localKey = id)
        return $this->hasMany(Tool::class);
    }
}
