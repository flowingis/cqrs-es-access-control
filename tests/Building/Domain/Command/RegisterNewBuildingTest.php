<?php

namespace App\Tests\Building\Domain\Command;


use App\Building\Application\BuildingCommandHandler;
use App\Building\Domain\Command\RegisterNewBuilding;
use App\Building\Domain\Event\NewBuildingWasRegistered;
use App\Building\Domain\Repository\BuildingAggregateRepository;
use Broadway\CommandHandling\CommandHandler;
use Broadway\CommandHandling\Testing\CommandHandlerScenarioTestCase;
use Broadway\EventHandling\EventBus;
use Broadway\EventStore\EventStore;
use Ramsey\Uuid\Uuid;

class RegisterNewBuildingTest extends CommandHandlerScenarioTestCase
{
    /**
     * @test
     */
    public function should_register_a_building()
    {
        $buildingId = Uuid::uuid4();
        $name = 'Stark Tower';
        $occurredAt = new \DateTimeImmutable();

        $this->scenario
            ->given()
            ->when(new RegisterNewBuilding($buildingId, $name, $occurredAt))
            ->then([
                new NewBuildingWasRegistered($buildingId, $name, $occurredAt)
            ]);
    }

    /**
     * Create a command handler for the given scenario test case.
     *
     * @param EventStore $eventStore
     * @param EventBus   $eventBus
     *
     * @return CommandHandler
     */
    protected function createCommandHandler(EventStore $eventStore, EventBus $eventBus): CommandHandler
    {
        return new BuildingCommandHandler(new BuildingAggregateRepository($eventStore, $eventBus));
    }
}
