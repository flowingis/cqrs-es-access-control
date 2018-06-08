<?php

namespace App\Building\Domain\Aggregate;


use App\Building\Domain\Event\NewBuildingWasRegistered;
use App\Building\Domain\Event\UserCheckedIn;
use App\Building\Domain\Event\UserCheckedOut;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

class Building extends EventSourcedAggregateRoot
{
    /**
     * @var UuidInterface
     */
    private $buildingId;

    /**
     * @var @string
     */
    private $name;

    /**
     * @param UuidInterface      $buildingId
     * @param string             $name
     * @param \DateTimeImmutable $occurredAt
     *
     * @return Building
     */
    public static function registerNew(UuidInterface $buildingId, string $name, \DateTimeImmutable $occurredAt)
    {
        $building = new self();
        $building->apply(
            new NewBuildingWasRegistered($buildingId, $name, $occurredAt)
        );

        return $building;
    }

    public function checkInUser(string $username, \DateTimeImmutable $occurredAt)
    {
        $this->apply(new UserCheckedIn(
            $this->buildingId,
            $username,
            $occurredAt
        ));
    }
    public function checkOutUser(string $username, \DateTimeImmutable $occurredAt)
    {
        $this->apply(new UserCheckedOut(
            $this->buildingId,
            $username,
            $occurredAt
        ));
    }

    protected function applyNewBuildingWasRegistered(NewBuildingWasRegistered $event)
    {
        $this->buildingId = $event->getBuildingId();
        $this->name = $event->getName();
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return $this->buildingId->toString();
    }
}
