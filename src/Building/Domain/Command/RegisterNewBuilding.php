<?php

namespace App\Building\Domain\Command;


use Ramsey\Uuid\UuidInterface;

class RegisterNewBuilding
{
    /**
     * @var UuidInterface
     */
    private $buildingId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var \DateTimeImmutable
     */
    private $occurredAt;

    /**
     * NewBuildingWasRegistered constructor.
     *
     * @param UuidInterface      $buildingId
     * @param string             $name
     * @param \DateTimeImmutable $occurredAt
     */
    public function __construct(UuidInterface $buildingId, string $name, \DateTimeImmutable $occurredAt)
    {
        $this->buildingId = $buildingId;
        $this->name = $name;
        $this->occurredAt = $occurredAt;
    }

    /**
     * @return UuidInterface
     */
    public function getBuildingId(): UuidInterface
    {
        return $this->buildingId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}
