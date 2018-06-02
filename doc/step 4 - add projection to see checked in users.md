- Partire dalla creazione del projecotor ```\App\Building\Application\CheckedInUsersProjector``` e dai suoi metodi per 
mettere in ascolto il proiettore. ``\App\Building\Application\CheckedInUsersProjector::applyUserCheckedIn`` e 
``\App\Building\Application\CheckedInUsersProjector::applyUserCheckedOut`` .

- Creare readmodel ```\App\Building\Domain\Readmodel\UserCheckIn``` e il relativo repository ``\App\Building\Domain\Readmodel\Repository\UserCheckInRepository``.

```
    App\Building\Domain\Readmodel\Repository\UserCheckInRepository:
          class: App\Building\Domain\Readmodel\Repository\UserCheckInRepository

    App\Building\Application\CheckedInUsersProjector:
            class: App\Building\Application\CheckedInUsersProjector
            arguments:
              - '@App\Building\Domain\Readmodel\Repository\UserCheckInRepository'
            tags:
                - { name: broadway.domain.event_listener}
```

- Creare api per ottenere tutti gli utenti che hanno fatto check in:

```
get_users_checked_in:
    path: /buildings/{buildingId}/users
    controller: App\Building\Infrastructure\Controller\BuildingController::getUsersCheckedIn
    methods: [GET]

```
