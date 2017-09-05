<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tool_types';

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
