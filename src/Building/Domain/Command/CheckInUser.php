<?php

namespace App\Building\Domain\Command;


use Ramsey\Uuid\UuidInterface;

class CheckInUser
{
    /**
     * @var UuidInterface
     */
    private $buildingId;
    /**
     * @var string
     */
    private $username;
    /**
     * @var \DateTimeImmutable
     */
    private $occurredAt;

    public function __construct(UuidInterface $buildingId, string $username, \DateTimeImmutable $occurredAt)
    {
        $this->buildingId = $buildingId;
        $this->username = $username;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}
