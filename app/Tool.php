<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tool extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tools';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'toolType_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];


    /**
     * Tool belongs to ToolType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toolType()
    {
        // belongsTo(RelatedModel, foreignKey = toolType_id, keyOnRelatedModel = id)
        return $this->belongsTo(ToolType::class, 'toolType_id', 'id');
    }

    /**
     * Tool has many Licenses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licenses()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = tool_id, localKey = id)
        return $this->hasMany(License::class);
    }

}
