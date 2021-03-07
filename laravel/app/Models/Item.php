<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //販売中
    const STATE_SELLING = 'selling';
    //購入済み
    const STATE_BOUGHT = 'bought';

    public function getIsStateSellingAttribute()
    {
        return $this->state === self::STATE_SELLING;
    }

    public function secondaryCategory()
    {
        return $this->BelongsTo(SecondaryCategory::class);
    }
}
