<?php

namespace pakages\Infrastructure\Repositories\Domain\Eloquent;

use Intervention\Image\Exception\NotFoundException;
use packages\Domain\Repositories\ItemRepositoryInterface\ItemId;
use packages\Domain\Repositories\ItemRepositoryInterface\Item;
use packages\Domain\Repositories\ItemRepositoryInterface\ItemRepository;
use pakages\Infrastructure\Repositories\Eloquents\EloquentItem;

class EloquentItemRepository implements ItemRepository
{
    private $eloquent;

    public function __construct(EloquentItem $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param ItemId $id
     * @return Item
     * @throws NotFoundException
     */
    public function findById(ItemId $id): Item
    {
        /** @var Domainable */
        /** @noinspection PhpUndefinedMethodInspection */
        $item = $this->eloquent->find($id->value());
        if(empty($item)) {
            throw new NotFoundException();
        }

        return $item->toDomain();
    }
}
