# cqrs-es-access-control

# Requisiti

- Docker

# Avvio applicazione

- `docker-compose up -d`
- `docker-compose exec php ./idephix.phar build`

Creare un edificio:
- `curl -X POST http://localhost:8080/buildings -d '{"name":"Stark Tower"}'`

Per controllare se l'applicazione sta funzionando correttamente dovreste ottenre la seguente risposta:
- `{"building":"UUID"}`

Registrare check in di un utente:
- `curl -X POST http://localhost:8080/buildings/{buildingId}/check-in -d '{"username":"ironman"}'`

Registrare check out di un utente:
- `curl -X POST http://localhost:8080/buildings/{buildingId}/check-out -d '{"username":"ironman"}'`

# Test

- `docker-compose exec php ./bin/phpunit`
- `docker-compose exec php ./bin/phpunit -c . --filter __FILTRO__`

# Tools

- Adminer: http://localhost:8081/
    - server: mysql
    - user: dev
    - password: dev
