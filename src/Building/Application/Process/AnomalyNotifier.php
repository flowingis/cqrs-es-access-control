<?php

namespace App\Building\Application\Process;


use App\Building\Domain\Command\NotifyAnomalyDetection;
use App\Building\Domain\Event\CheckInAnomalyDetected;
use Broadway\CommandHandling\CommandBus;
use Broadway\Processor\Processor;

class AnomalyNotifier extends Processor
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handleCheckInAnomalyDetected(CheckInAnomalyDetected $event)
    {
        $this->commandBus->dispatch(
            new NotifyAnomalyDetection($event->getBuildingId(), $event->getUsername(), $event->getOccurredAt())
        );
    }
}
