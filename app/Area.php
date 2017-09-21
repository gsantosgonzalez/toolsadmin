<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_areas';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name', 'responsible'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Area has many AssignLicensse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignLicenses()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = area_id, localKey = id)
        return $this->hasMany(AssignLicense::class);
    }

    /**
     * Area belongs to Responsible.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsible()
    {
        // belongsTo(RelatedModel, foreignKey = responsible_id, keyOnRelatedModel = id)
        return $this->belongsTo(Employee::class, 'responsible', 'id');
    }

}
