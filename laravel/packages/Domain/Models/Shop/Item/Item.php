<?php

namespace packages\Domain\Models\Shop\Item;


class Item
{
    /** @var ItemId */
    private $id;

    /** @var string */
    private $name;

    /** @var ItemPrice*/
    private $price;

    /** @var Stock */
    private $stock;

    /**
     * @param ItemId $id
     * @param string $name
     * @param ItemPrice $price
     * @param Stock $stock
     */
    public function __construct
    (
        ItemId $id,
        string $name,
        ItemPrice $price,
        Stock $stock
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    //setter and getter
    /**
     * @param ItemCount $count
     * @return bool
     */
      //演算に関係するもの
    public function isStockSufficient(ItemCount $count): bool
    {
        return $this->stock()->isSufficient($count);
    }

    public function stock(): Stock
    {
        return $this->stock;
    }

    public function id(): ItemId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): ItemPrice
    {
        return $this->price;
    }

    /**
     * @param Item $item
     * @return bool
     */
    public function equals(self $item): bool
    {
        return $this->id()->equals($item->id());
    }
    /**
     *   public function equals(self $id): bool
    *{
    *    return $this->value === $id->value;
    *}
     */
}
