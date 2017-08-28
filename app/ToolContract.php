<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolContract extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tool_contracts';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['contract_date', 'cost', 'frecuency'];

    /**
     * ToolContract belongs to Tool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tool()
    {
        // belongsTo(RelatedModel, foreignKey = tool_id, keyOnRelatedModel = id)
        return $this->belongsTo(Tool::class);
    }

}
