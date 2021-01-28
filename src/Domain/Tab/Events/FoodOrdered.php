<?php

namespace Src\Domain\Tab\Events;

use Codderz\Yoko\Support\Collection;
use Codderz\Yoko\Support\Domain\Guid;
use Src\Domain\Tab\OrderedItem;

class FoodOrdered
{
    public Guid $id;
    /** @var Collection<OrderedItem> */
    public Collection $items;

    public static function of(Guid $id, Collection $items)
    {
        $self = new self();
        $self->id = $id;
        $self->items = $items->assertInstance(OrderedItem::class);
        return $self;
    }
}
