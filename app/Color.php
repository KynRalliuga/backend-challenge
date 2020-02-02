<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model{

    protected $table = 'colors';

    protected $fillable = [
        'nome_cor',
        'hex_code_cor'
    ];

    public $timestamps = true;

}
