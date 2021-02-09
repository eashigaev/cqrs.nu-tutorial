<?php

namespace Src\Application\Write;

use Codderz\Yoko\Layers\Application\Events\EventEmitter\EventEmitterInterface;
use Codderz\Yoko\Layers\Application\Read\QueryBus\QueryBusInterface;
use Codderz\Yoko\Layers\Infrastructure\Messenger\Actions\ActionHandlerInterface;
use Codderz\Yoko\Layers\Infrastructure\Messenger\Actions\HandleTrait;
use Src\Application\Read\OpenTabs\Queries\GetActiveTableNumbers;
use Src\Domain\Tab\Commands\CloseTab;
use Src\Domain\Tab\Commands\MarkDrinksServed;
use Src\Domain\Tab\Commands\MarkFoodPrepared;
use Src\Domain\Tab\Commands\MarkFoodServed;
use Src\Domain\Tab\Commands\OpenTab;
use Src\Domain\Tab\Commands\PlaceOrder;
use Src\Domain\Tab\TabAggregate;
use Src\Domain\Tab\TabRepositoryInterface;

class TabHandler implements ActionHandlerInterface
{
    use HandleTrait;

    protected EventEmitterInterface $eventEmitter;
    protected QueryBusInterface $queryBus;
    protected TabRepositoryInterface $tabRepository;

    public function __construct(
        EventEmitterInterface $eventEmitter,
        QueryBusInterface $queryBus,
        TabRepositoryInterface $tabRepository
    )
    {
        $this->eventEmitter = $eventEmitter;
        $this->queryBus = $queryBus;
        $this->tabRepository = $tabRepository;
    }

    public function openTab(OpenTab $command)
    {
        $activeTableNumbers = $this->queryBus->handle(GetActiveTableNumbers::of());

        $tab = TabAggregate::openTab($command, $activeTableNumbers);
        $this->tabRepository->save($tab);
        $this->eventEmitter->emitAll($tab->releaseEvents());
    }

    public function placeOrder(PlaceOrder $command)
    {
        $tab = $this->tabRepository->ofId($command->id);
        $tab->placeOrder($command);
        $this->tabRepository->save($tab);
        $this->eventEmitter->emitAll($tab->releaseEvents());
    }

    public function markDrinksServed(MarkDrinksServed $command)
    {
        $tab = $this->tabRepository->ofId($command->id);
        $tab->markDrinksServed($command);
        $this->tabRepository->save($tab);
        $this->eventEmitter->emitAll($tab->releaseEvents());
    }

    public function markFoodPrepared(MarkFoodPrepared $command)
    {
        $tab = $this->tabRepository->ofId($command->id);
        $tab->markFoodPrepared($command);
        $this->tabRepository->save($tab);
        $this->eventEmitter->emitAll($tab->releaseEvents());
    }

    public function markFoodServed(MarkFoodServed $command)
    {
        $tab = $this->tabRepository->ofId($command->id);
        $tab->markFoodServed($command);
        $this->tabRepository->save($tab);
        $this->eventEmitter->emitAll($tab->releaseEvents());
    }

    public function closeTab(CloseTab $command)
    {
        $tab = $this->tabRepository->ofId($command->id);
        $tab->closeTab($command);
        $this->tabRepository->save($tab);
        $this->eventEmitter->emitAll($tab->releaseEvents());
    }
}
