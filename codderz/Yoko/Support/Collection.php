<?php

namespace Codderz\Yoko\Support;

use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection
{
    public static function fromBase(BaseCollection $collection)
    {
        return self::make($collection->all());
    }

    public function assert(callable $callback)
    {
        return $this->each(function ($item) use ($callback) {
            if (!$callback($item)) throw new \InvalidArgumentException();
        });
    }

    public function assertInstance(string $type)
    {
        return $this->assert(fn($item) => is_a($item, $type));
    }

    public function assertInt()
    {
        return $this->assert(fn($item) => is_int($item));
    }

    public function remove($item)
    {
        return $this->reject(fn($elem) => $elem === $item);
    }

    public function removeFirst($item)
    {
        $index = $this->search($item);
        return $this->forget($index)->values();
    }
}
