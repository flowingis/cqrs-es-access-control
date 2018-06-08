<?php

namespace App\Building\Domain\Readmodel;

use Broadway\ReadModel\Identifiable;
use Ramsey\Uuid\UuidInterface;

class UserCheckIn implements Identifiable, \JsonSerializable
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
     * @return string
     */
    public function getId(): string
    {
        return $this->username;
    }

    /**
     * @return UuidInterface
     */
    public function getBuildingId(): UuidInterface
    {
        return $this->buildingId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'username' => $this->username,
            'occurredAt' => $this->occurredAt->format('Y-m-i H:i')
        ];
    }
}
