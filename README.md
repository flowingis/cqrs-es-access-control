# cqrs-es-access-control

# Requisiti

- Docker

# Avvio applicazione

- `docker-compose up -d`
- `docker-compose exec php ./idephix.phar build`

Creare un edificio:
- `curl -X POST http://localhost:8080/buildings -d '{"name":"Stark Tower"}'`

Registrare check in di un utente:
- `curl -X POST http://localhost:8080/buildings/{buildingId}/check-in -d '{"username":"ironman"}'`

Registrare check out di un utente:
- `curl -X POST http://localhost:8080/buildings/{buildingId}/check-out -d '{"username":"ironman"}'`

# Tools

- Adminer: http://localhost:8081/
    - server: mysql
    - user: dev
    - password: dev
