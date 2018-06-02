Check in:
- Partire dal metodo ``\App\Building\Infrastructure\Controller\BuildingController::checkIn`` implementando la ``dispatch`` del comando ``CheckInUser`` 
- Creare ed implementare il metodo ``\App\Building\Domain\BuildingCommandHandler::handleCheckInUser`` per la gestione del del comando inviato
- Implementare il metodo ``\App\Building\Domain\Aggregate\Building::checkInUser`` che contiene la logica per la registrazione del check in. 
Questo implica la creazione dell'evento ``\App\Building\Domain\Event\UserCheckedIn``

Check out:
- Partire dall'implementazione delmetodo ``\App\Building\Domain\Aggregate\Building::checkOutUser`` che contiene la logica per la registrazione del check out. 
Questo implica la creazione dell'evento ``\App\Building\Domain\Event\UserCheckedOut``
- Creare ed implementare il metodo ``\App\Building\Domain\BuildingCommandHandler::handleCheckOutUser`` per la gestione del del comando inviato
- Infine implementare il metodo ``\App\Building\Infrastructure\Controller\BuildingController::checkOut`` implementando la ``dispatch`` del comando ``CheckOutUser`` 
