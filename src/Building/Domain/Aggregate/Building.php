<?php

namespace App\Building\Domain\Aggregate;


use App\Building\Domain\Event\NewBuildingWasRegistered;
use App\Building\Domain\Event\UserCheckedIn;
use App\Building\Domain\Event\UserCheckedOut;
use App\Building\Domain\Exception\DoubleCheckInForbidden;
use App\Building\Domain\Exception\DoubleCheckOutForbidden;
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
     * @var array
     */
    private $usersCheckedIn = [];

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
        if (array_key_exists($username, $this->usersCheckedIn)) {
            throw new DoubleCheckInForbidden('double check in forbidden for ' . $username);
        }

        $this->apply(new UserCheckedIn(
            $this->buildingId,
            $username,
            $occurredAt
        ));
    }
    public function checkOutUser(string $username, \DateTimeImmutable $occurredAt)
    {
        if (!array_key_exists($username, $this->usersCheckedIn)) {
            throw new DoubleCheckOutForbidden('double check out forbidden for ' . $username);
        }

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

    protected function applyUserCheckedIn(UserCheckedIn $event)
    {
        $this->usersCheckedIn[$event->getUsername()] = null;
    }

    protected function applyUserCheckedOut(UserCheckedOut $event)
    {
        unset($this->usersCheckedIn[$event->getUsername()]);
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return $this->buildingId->toString();
    }
}
