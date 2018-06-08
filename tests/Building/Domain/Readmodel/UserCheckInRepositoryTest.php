<?php

namespace App\Tests\Building\Domain\Readmodel;


use App\Building\Application\CheckedInUsersProjector;
use App\Building\Domain\Event\UserCheckedIn;
use App\Building\Domain\Readmodel\UserCheckIn;
use Broadway\ReadModel\InMemory\InMemoryRepository;
use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Testing\ProjectorScenarioTestCase;
use Ramsey\Uuid\Uuid;

class UserCheckInRepositoryTest extends ProjectorScenarioTestCase
{
    /**
     * @test
     */
    public function should_project_a_user_check_in()
    {
        $buildingId = Uuid::uuid4();
        $username = 'ironman';
        $occurredAt = new \DateTimeImmutable();

        $this->scenario
            ->given([])
            ->when(new UserCheckedIn($buildingId, $username, $occurredAt))
            ->then(
                [new UserCheckIn($buildingId, $username, $occurredAt)]
            );
    }

    /**
     * @return Projector
     */
    protected function createProjector(InMemoryRepository $repository): Projector
    {
        return new CheckedInUsersProjector($repository);
    }
}
