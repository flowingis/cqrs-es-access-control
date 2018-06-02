<?php

namespace App\Building\Domain\Repository;

use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;

class BuildingAggregateRepository extends EventSourcingRepository
{
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            '\App\Building\Domain\Aggregate\Building',
            new PublicConstructorAggregateFactory());
    }
}
