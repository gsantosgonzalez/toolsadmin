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
    protected $table = 'cat_tool_types';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Type has many Tools.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tools()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = type_id, localKey = id)
        return $this->hasMany(Tool::class, 'toolType_id', 'id');
    }
}
