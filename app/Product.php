<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{

    protected $table = 'products';

    protected $fillable = [
        'titulo',
        'descricao',
        'quantidade',
        'cores_array',
        'color_id',
        'user_id',
    ];

    public $timestamps = true;

}
