# Library
Making simple library app

# Build
docker-compose build

# Run
1. docker-compose up -d
2. php artisan migrate --seed

# TechStack
1. Laravel
2. MySql
3. Composer

# Development

**Local docker**

Start: `docker-compose up`

Stop: `docker-compose stop`

Restart container: `docker-compose restart <CONTAINER_NAME>`

Exec in container: `docker exec -it <CONTAINER_ID> bash`

Migrations: `docker exec -it lib_app php artisan migrate --seed`
