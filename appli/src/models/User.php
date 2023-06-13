<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'user';
    protected $primaryKey = 'email';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'nom',
        'prenom'
    ];
}