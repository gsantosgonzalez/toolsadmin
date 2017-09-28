<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invitations';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['email', 'typeUser_id', 'token'];
}
