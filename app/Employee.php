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
    protected $table = 'cat_employees';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Employee has one Area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function area()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = employee_id, localKey = id)
        return $this->hasOne(Area::class, 'responsible', 'id');
    }

}
