<?php

namespace Codderz\Yoko\Layers\Infrastructure\Messaging;

use Codderz\Yoko\Support\Reflect;

trait HandleMessageTrait
{
    public function handle($message)
    {
        $method = lcfirst(Reflect::shortClass($message));

        if (method_exists($this, $method) && Reflect::paramTypes($this, $method) === [get_class($message)]) {
            return $this->$method($message);
        }

        throw HandleMessageException::new();
    }
}