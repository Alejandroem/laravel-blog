<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    //fillable permite ciertos campos, guarded no permite ciertos campos
    protected $guarded=[];
}
