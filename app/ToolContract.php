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
}
