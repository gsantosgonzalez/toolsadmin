<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'petitions';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name', 'details'];
}
