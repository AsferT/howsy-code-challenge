# Commands and URLs

Start Docker

    cd docker
    docker compose up -d

Check Docker Logs

    docker compose logs -f php

Composer should be run after `docker compose up -d`

    docker compose exec php composer install

Run the Testsuite (PHPUnit, PHPLint, PHPMD and PHPCS)

    docker compose exec php composer run-tests
