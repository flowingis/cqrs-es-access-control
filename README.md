# cqrs-es-access-control

# Requisiti

- Docker

# Avvio applicazione

- `docker-compose up -d`
- `docker-compose exec php ./idephix.phar build`

Creare un edificio:
- `curl -X POST http://localhost:8080/buildings -d '{"name":"Stark Tower"}'`

# Tools

- Adminer: http://localhost:8081/
    - server: mysql
    - user: dev
    - password: dev

