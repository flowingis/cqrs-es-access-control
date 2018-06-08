<?php

namespace App\Building\Domain\Event;


use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UserCheckedIn implements Serializable
{
    /**
     * @var UuidInterface
     */
    private $buildingId;
    /**
     * @var \DateTimeImmutable
     */
    private $occurredAt;
    /**
     * @var string
     */
    private $username;

    /**
     * NewBuildingWasRegistered constructor.
     *
     * @param UuidInterface      $buildingId
     * @param string             $username
     * @param \DateTimeImmutable $occurredAt
     */
    public function __construct(UuidInterface $buildingId, string $username, \DateTimeImmutable $occurredAt)
    {
        $this->buildingId = $buildingId;
        $this->occurredAt = $occurredAt;
        $this->username = $username;
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
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(
            Uuid::fromString($data['buildingId']),
            $data['name'],
            \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data['occurredAt'])
        );
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'buildingId' => $this->buildingId->toString(),
            'occurredAt' => $this->occurredAt->format('Y-m-d H:i:s'),
            'name' => $this->username
        ];
    }
}
