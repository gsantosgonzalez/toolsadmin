<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_users';

    /**
     * TypeUser has many Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = typeUser_id, localKey = id)
    	return $this->hasMany(User::class);
    }
}
