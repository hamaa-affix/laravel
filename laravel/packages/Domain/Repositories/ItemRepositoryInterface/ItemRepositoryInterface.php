<?php

namespace packages\Domain\Repositories\ItemRepositoryInterface;

interface ItemRepository
{
    public function findById(ItemId $id): Item;
}

