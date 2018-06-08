<?php

namespace App\Building\Domain\Readmodel\Repository;

use App\Building\Domain\Readmodel\UserCheckIn;
use Broadway\ReadModel\Identifiable;
use Broadway\ReadModel\Repository;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

class UserCheckInRepository implements Repository
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Identifiable $userCheckIn)
    {
        $this->connection->insert('users_checked_in', [
            'buildingId' => $userCheckIn->getBuildingId()->toString(),
            'username' => $userCheckIn->getId(),
            'occurredAt' => $userCheckIn->getOccurredAt()->format('Y-m-d H:i')
        ]);
    }

    /**
     * @param mixed $id
     *
     * @return Identifiable|null
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * @param array $fields
     *
     * @return Identifiable[]
     */
    public function findBy(array $fields): array
    {
        $usersData = $this->connection->fetchAll(
            'select * from users_checked_in where buildingId=?',
            [$fields['buildingId']]
        );

        $users = [];
        foreach ($usersData as $userData) {
            $users[] = new UserCheckIn(
                Uuid::fromString($userData['buildingId']),
                $userData['username'],
                \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $userData['occurredAt'])
            );
        }

        return $users;
    }

    /**
     * @return Identifiable[]
     */
    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param mixed $id
     */
    public function remove($id)
    {
        $this->connection->delete('users_checked_in', ['username' => $id]);
    }
}
