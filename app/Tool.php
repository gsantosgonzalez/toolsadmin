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
    protected $fillable = ['name', 'description', 'type_id', 'area_id', 'responsible_id'];

    /**
     * Tool belongs to Area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        // belongsTo(RelatedModel, foreignKey = area_id, keyOnRelatedModel = id)
        return $this->belongsTo(Area::class);
    }

    /**
     * Tool belongs to Type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        // belongsTo(RelatedModel, foreignKey = type_id, keyOnRelatedModel = id)
        return $this->belongsTo(Type::class);
    }

    /**
     * Tool belongs to Responsible.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsible()
    {
        // belongsTo(RelatedModel, foreignKey = responsible_id, keyOnRelatedModel = id)
        return $this->belongsTo(Responsible::class);
    }

    /**
     * Tool has many ToolContracts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toolContracts()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = tool_id, localKey = id)
        return $this->hasMany(ToolContract::class)->where('status', '=', 1);
    }

}
