<?php

namespace App\Building\Infrastructure\Notification;

use App\Building\Domain\Command\NotifyAnomalyDetection;
use Broadway\CommandHandling\SimpleCommandHandler;
use Monolog\Logger;

class NotificationCommandHandler extends SimpleCommandHandler
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    protected function handleNotifyAnomalyDetection(NotifyAnomalyDetection $command): void
    {
        $this->logger->warning(
            'Anomaly detected in building '.$command->getBuildingId()->toString().' for user '.$command->getUsername()
        );
    }
}
