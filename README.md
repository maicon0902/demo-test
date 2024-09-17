### How to run
- Install docker, docker compose
- `cp .env.example .env`
- `docker-compose up -d`
- `docker exec -it app_php /bin/bash`
    - `composer install`
    - `php artisan key:gen`
    - `php artisan migrate --seed`
- Open http://localhost:9922