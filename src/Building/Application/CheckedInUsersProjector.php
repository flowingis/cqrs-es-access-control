<?php

namespace App\Building\Application;


use App\Building\Domain\Event\UserCheckedIn;
use App\Building\Domain\Event\UserCheckedOut;
use App\Building\Domain\Readmodel\UserCheckIn;
use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;

class CheckedInUsersProjector extends Projector
{
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function applyUserCheckedIn(UserCheckedIn $event)
    {
        $this->repository->save(
            new UserCheckIn($event->getBuildingId(), $event->getUsername(), $event->getOccurredAt())
        );
    }

    public function applyUserCheckedOut(UserCheckedOut $event)
    {
        $this->repository->remove($event->getUsername());
    }
}
