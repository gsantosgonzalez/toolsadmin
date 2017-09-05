<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractTool extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contract_tools';

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
