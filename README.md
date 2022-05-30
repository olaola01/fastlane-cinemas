# FASTLANE (Laravel + Vue Js)

App is deployed on Heroku - https://sleepy-coast-23125.herokuapp.com

## Getting started

1. Clone this repository
2. Generate an env file by running `copy .env.example .env`
3. Set up env with your database name, user and password
4. Run `composer install`
5. Run `php artisan key:generate`
6. After setting up the env, run `php artisan migrate` to migrate the database
7. Then finally run `php artisan serve` to start the server

### Configure Sanctum on env
Add config keys
`
SESSION_DOMAIN=domain.name
SANCTUM_STATEFUL_DOMAIN=domain.name
`
And Set `SESSION_DRIVER=cookie`

