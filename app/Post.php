<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
{

   

    protected $connection = 'mongodb';

    protected $fillable = [
        '_id','title', 'content','author','image'
    ];
}
