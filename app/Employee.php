<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Responsible has many Tools.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tools()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = responsible_id, localKey = id)
        return $this->hasMany(Tool::class);
    }
}
