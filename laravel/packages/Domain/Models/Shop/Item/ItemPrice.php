<?php
namespace packages\Domain\Models\Shop\Item;

use packages\Domain\Models\PositiveNumber;

class ItemPrice extends PositiveNumber
{
    /**
     * @param ItemCount $count
     * @return ItemSubtotal
     */
    public function calcSubtotal(ItemCount $count): ItemSubtotal
    {
        return ItemSubtotal::of($this->value * $count->value());
    }
}
