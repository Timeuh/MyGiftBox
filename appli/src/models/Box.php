<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Box extends Model
{
    protected $table = 'box';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    public function prestation(): BelongsToMany
    {
        return $this->belongsToMany('gift\app\models\Prestation',
            'box2presta',
            'box_id',
            'presta_id')
            ->withPivot('quantite','date');
    }
}

enum Status
{
    const CREATED = 1;
}