<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model {
    protected $table = 'user';
    protected $primaryKey = 'email';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'nom',
        'prenom'
    ];
}