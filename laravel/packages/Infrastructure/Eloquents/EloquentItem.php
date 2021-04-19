<?php

namespace pakages\Infrastructure\Repositories\Eloquents;

use packages\Domain\Models\Shop\Item\Item;
use packages\Domain\Models\Shop\Item\ItemId;
use packages\Domain\Models\Shop\Item\ItemPrice;
use packages\Domain\Domin\Domainable;
use packages\Domain\Models\Shop\Item\Stock;
use packages\Infrastructure\Eloquents\AppEloquent;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $stock
 */
class EloquentItem extends AppEloquent implements Domainable
{
    protected $table = 'items';

    /**
     * @return Item
     */
    public function toDomain(): Item
    {
        return new Item(
            ItemId::of($this->id),
            $this->name,
            ItemPrice::of($this->price),
            Stock::of($this->stock)
        );
    }
}
