<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'password', 'remember_token',
    ];

    /**
     * User belongs to TypeUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeUser()
    {
        // belongsTo(RelatedModel, foreignKey = typeUser_id, keyOnRelatedModel = id)
        return $this->belongsTo(TypeUser::class, 'typeUser_id', 'id');
    }

}
