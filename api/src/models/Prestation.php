<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Prestation extends Model {
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'libelle',
        'description',
        'url',
        'unite',
        'tarif',
        'img',
        'cat_id'
    ];

    public function categorie(): BelongsTo {
        return $this->belongsTo(Categorie::class, 'cat_id', 'id');
    }

    public function box(): BelongsToMany {
        return $this->belongsToMany('gift\app\models\Box',
            'box2presta',
            'presta_id',
            'box_id')
            ->withPivot('quantite')
            ->withPivot('date');
    }
}

