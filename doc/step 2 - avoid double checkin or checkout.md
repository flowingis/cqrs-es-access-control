- Aggiungere la logica che impedisce il doppio check in al metodo``\App\Building\Domain\Aggregate\Building::checkInUser``
- Implementare il metodo ``\App\Building\Domain\Aggregate\Building::applyUserCheckedIn`` per tenere traccia degli utenti che hanno fatto check in
- Generare un eccezione ``\App\Building\Domain\Exception\DoubleCheckInForbidden`` (da creare) nel caso in cui ci siano un doppio checkin.
- Aggiungere try/catch alla ```\App\Building\Infrastracture\Controller\BuildingController::checkIn``` per catturare l'eccezione ``\App\Building\Domain\Exception\DoubleCheckInForbidden`` 

- Aggiungere la logica che impedisce il doppio check out nei rispettivi metodi ``\App\Building\Domain\Aggregate\Building::checkOutUser``
- Implementare il metodo ``\App\Building\Domain\Aggregate\Building::applyUserCheckedOut`` per tenere traccia degli utenti che hanno fatto check in
- Generare un eccezione ``\App\Building\Domain\Exception\DoubleCheckOutForbidden`` (da creare) nel caso in cui ci siano un doppio checkin.
- Aggiungere try/catch alla ```\App\Building\Infrastructure\Controller\BuildingController::checkOut``` per catturare l'eccezione ``\App\Building\Domain\Exception\DoubleCheckOutForbidden`` 


