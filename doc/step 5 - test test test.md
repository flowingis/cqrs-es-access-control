- Creare file ```\App\Tests\Building\Domain\Command\RegisterNewBuildingTest```:

```
class RegisterNewBuildingTest extends CommandHandlerScenarioTestCase
{
    /**
     * @test
     */
    public function should_register_a_building()
    {
        $this->scenario
            ->given()
            ->when()
            ->then()
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
```

- Provare a costruire test per gli altri comandi

- Creare test ``\App\Tests\Building\Domain\Readmodel\UserCheckInRepositoryTest`` per read model ``\App\Building\Domain\Readmodel\UserCheckIn``:

```
class UserCheckInRepositoryTest extends ProjectorScenarioTestCase
{
    /**
     * @test
     */
    public function should_project_a_user_check_in()
    {
        $this->scenario
            ->given([])
            ->when()
            ->then();
    }
    
    /**
     * @return Projector
     */
    protected function createProjector(InMemoryRepository $repository): Projector
    {
        return new CheckedInUsersProjector($repository);
    }
}
```

- Provare a costruire test per le altre proiezioni sullo stesso readmodel
