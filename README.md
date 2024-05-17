# restful-api-laravel &middot; ![Coverage](https://img.shields.io/badge/Coverage-100%25-brightgreen)

A RESTful API server includes

* Framework: Laravel
* OpenAPI: Swagger
* Database: MySQL (SQLite for test)
* ORM: Eloquent
* Test: PHPUnit
* Environment: Docker
* Deployment: Docker Compose

## Usage

### Build Database

```shell
docker-compose up -d mysql
```

* username: root
* password: pass

### Develop

```shell
php artisan serve
```

[Swagger](http://localhost:8000/docs)

### Test

```shell
php artisan test --coverage
```

### Deploy

```shell
docker build . -t restful-api-laravel
docker-compose up -d
```

## Other commands

```shell
composer global require "laravel/installer"
laravel new <website name>

# development
php artisan make:controller api/UserController --api
php artisan make:model User
php artisan make:migration create_user_table --create="user"
php artisan migrate
php artisan l5-swagger:generate

# test
php artisan make:seeder UserTableSeeder
php artisan db:seed --class=UserTableSeeder
php artisan make:factory UserFactory --model=User
php artisan db:factory --class=UserFactory
php artisan make:test UserTest
```
