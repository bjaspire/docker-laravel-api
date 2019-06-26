<p align="center">Docker Laravel jwt api boilplate</p>



## Installation with Docker

Make sure that docker is installed on your machine

- git clone 
- docker run --rm -v $(pwd):/app composer install
- cp .env.example .env
- docker-compose up -d
- docker-compose exec app nano .env
 <pre>
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=password
</pre>
- docker-compose exec app php artisan key:generate
- docker-compose exec app php artisan config:cache
As a final step, visit http://your_server_ip in the browser.



## Generate Doc for API
- php artisan apidoc:generate

## Unit test
<p> Create new database and add it into .env.testing </p>

# run
- ./vendor/bin/phpunit
