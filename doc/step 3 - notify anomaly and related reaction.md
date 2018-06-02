- Sostituire l'eccezione ```\App\Building\Domain\Exception\DoubleCheckInForbidden``` e ```\App\Building\Domain\Exception\DoubleCheckOutForbidden``` nell'aggregato
con l'evento che segnala che è avvenuta un'anomalia ```\Building\Domain\DomainEvent\CheckInAnomalyDetected```. Ogni volta che arrivare un check in o check out
l'evento relativo deve essere salvato e poi va controllata se c'è un'anomalia.
- Creare il processo per inviare la notifica dopo il rilevamento dell'anomalia. Creare una classe ```\App\Building\Application\Process\AnomalyNotifier``` che estende
```\Broadway\Processor\Processor``` e implementare un metodo ```public function handleCheckInAnomalyDetected(CheckInAnomalyDetected $event)``` che lancia
comando ```\App\Building\Domain\Command\NotifyAnomalyDetection``` che va creato.
- Creare il command handler ```\App\Building\Infrastructure\Notification\NotificationCommandHandler``` per gestire il comando  ```\App\Building\Domain\Command\NotifyAnomalyDetection```
Configurazione necessaria:

```
App\Building\Application\Process\AnomalyNotifier:
        class: App\Building\Application\Process\AnomalyNotifier
        arguments:
          - '@broadway.command_handling.simple_command_bus'
        tags:
            - { name: broadway.domain.event_listener}

    App\Building\Infrastructure\Notification\NotificationCommandHandler:
            class: App\Building\Infrastructure\Notification\NotificationCommandHandler
            arguments: ['@logger']
            tags:
                - { name: broadway.command_handler }

```
