<?php

namespace Codderz\Yoko\Layers\Application\Read\ReadModel;

use Codderz\Yoko\Support\Reflect;

class ReadModel implements ReadModelInterface
{
    public function apply($event)
    {
        $method = __FUNCTION__ . Reflect::shortClass($event);

        if (method_exists($this, $method)) {
            $this->$method($event);
            return $this;
        };

        throw new \Error(
            get_class($this) . " does not know how to apply event " . get_class($event)
        );
    }

    public function withEvents(array $events = [])
    {
        foreach ($events as $event) {
            $this->apply($event);
        }
        return $this;
    }
}
