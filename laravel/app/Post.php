<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public function user() {
        return $this->belongsTo('App\User',  'foreign_key');
    }
}
