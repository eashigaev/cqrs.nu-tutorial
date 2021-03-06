<?php

namespace Codderz\Yoko\Layers\Infrastructure\MessageBus;

interface MessageResolverInterface
{
    public function bind($handler, string $message): self;

    public function bindAll($handler, array $messages): self;

    public function resolve($message);
}
