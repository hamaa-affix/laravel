<?php
namespace packages\Domain\Models\Shop\Item;

use packages\Domain\Models\PositiveNumber;

class ItemCount extends PositiveNumber
{
    /**
     *@param ItemCount $count
     *@return ItemCount
     */
    public function add(self $count): self
    {
        return self::of($this->value + $count->value);
    }
}
