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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];


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

    /**
     * ContractTool belongs to Area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        // belongsTo(RelatedModel, foreignKey = area_id, keyOnRelatedModel = id)
        return $this->belongsTo(Area::class);
    }

    /**
     * ContractTool belongs to Frecuency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function frecuency()
    {
        // belongsTo(RelatedModel, foreignKey = frecuency_id, keyOnRelatedModel = id)
        return $this->belongsTo(Frecuency::class);
    }

    /**
     * ContractTool belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        // belongsTo(RelatedModel, foreignKey = currency_id, keyOnRelatedModel = id)
        return $this->belongsTo(Currency::class);
    }

    /**
     * ContractTool belongs to Card.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        // belongsTo(RelatedModel, foreignKey = card_id, keyOnRelatedModel = id)
        return $this->belongsTo(Card::class);
    }

}
