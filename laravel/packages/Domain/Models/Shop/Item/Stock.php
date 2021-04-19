<?php

namespace packages\Domain\Models\Shop\Item;

use packages\Domain\Models\PositiveNumber;

class Stock extends PositiveNumber
{
    /**
     * @param ItemCount $count
     * @return bool
     */
    public function isSufficient(ItemCount $count): bool
    {
        return $this->value() >= $count->value();
    }
}
