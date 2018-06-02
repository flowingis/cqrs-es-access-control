<?php

namespace App\Building\Infrastructure\Controller;

use App\Building\Domain\Command\RegisterNewBuilding;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BuildingController extends Controller
{
    public function registerNew(Request $request)
    {
        $commandBus = $this->get('broadway.command_handling.command_bus');
        $buildingData = json_decode($request->getContent(), true);

        $buildingId = Uuid::uuid4();

        $commandBus->dispatch(
            new RegisterNewBuilding(
                $buildingId,
                $buildingData['name'],
                new \DateTimeImmutable()
            )
        );

        return new JsonResponse(["building" => $buildingId], 201);
    }

    public function checkIn(Request $request)
    {

    }

    public function checkOut(Request $request)
    {

    }
}
