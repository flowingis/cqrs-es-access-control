<?php

namespace App\Building\Application;

use App\Building\Domain\Aggregate\Building;
use App\Building\Domain\Command\RegisterNewBuilding;
use App\Building\Domain\Command\CheckInUser;
use App\Building\Domain\Command\CheckOutUser;
use Broadway\CommandHandling\SimpleCommandHandler;
use Broadway\Repository\Repository;

class BuildingCommandHandler extends SimpleCommandHandler
{
    /**
     * @var Repository
     */
    private $aggregateRepository;

    /**
     * BuildingCommandHandler constructor.
     *
     * @param Repository $aggregateRepository
     */
    public function __construct(Repository $aggregateRepository)
    {
        $this->aggregateRepository = $aggregateRepository;
    }

    protected function handleRegisterNewBuilding(RegisterNewBuilding $command): void
    {
        $this->aggregateRepository->save(
            Building::registerNew(
                $command->getBuildingId(),
                $command->getName(),
                $command->getOccurredAt()
            )
        );
    }

    protected function handleCheckInUser(CheckInUser $command): void
    {
        /** @var Building $building */
        $building = $this->aggregateRepository->load($command->getBuildingId());

        $building->checkInUser($command->getUsername(), $command->getOccurredAt());

        $this->aggregateRepository->save($building);
    }

    protected function handleCheckOutUser(CheckOutUser $command): void
    {
        /** @var Building $building */
        $building = $this->aggregateRepository->load($command->getBuildingId());

        $building->checkOutUser($command->getUsername(), $command->getOccurredAt());

        $this->aggregateRepository->save($building);
    }
}
