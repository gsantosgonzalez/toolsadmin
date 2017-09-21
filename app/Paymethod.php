<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymethod extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_paymethods';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name', 'details'];

    /**
     * Paymethod has many Licenses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licenses()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = paymethod_id, localKey = id)
        return $this->hasMany(License::class);
    }

}
