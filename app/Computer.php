<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'computers';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['code'];

    /**
     * Computer belongs to many (many-to-many) License.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function licenses()
    {
        // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = computer_id, otherKeyOnPivot = license_id)
        return $this->belongsToMany(License::class, 'assign_licenses');
    }

}
