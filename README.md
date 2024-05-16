# restful-api-laravel

```shell
composer global require "laravel/installer"
laravel new <website name>
php artisan serve
php artisan make:controller api/UserController --api
php artisan make:model User
php artisan make:migration create_user_table --create="user"
php artisan migrate
php artisan make:seeder UserTableSeeder
composer dump-autoload
php artisan db:seed --class=UserTableSeeder
php artisan make:factory UserFactory --model=User
php artisan db:factory --class=UserFactory
php artisan make:test UserTest
```
