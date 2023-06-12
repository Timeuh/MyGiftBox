<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model {
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'libelle',
        'description'
    ];

    public function prestation(): HasMany {
        return $this->hasMany('gift\app\models\Prestation', 'cat_id');
    }
}