# Laravel InvFest x ISF 9.0 Registration Web

This project is a registration portal that allows user to register and submit their project and administrators can manage web application from various aspects of the application, also checking user registration data including proof of payment and make sure all user data is valid.

## Overview

### Admin Dashboard

- The heart of the system, where authorized users can log in and access powerful tools.
- Admins can modify application setting, such as the title, description, and other essential information.
- Content management: Admins can update the web timeline content, ensuring it stays fresh and relevant.

### Security and Permissions

- Role-based access control (RBAC): Different admin roles (admin, petugas, user, etc.) with varying permissions.
- Authentication and authorization: Ensuring only authorized users can access the dashboard.
- Content Security Policy (CSP): Checking all content is safe to go, and prevent any xss injection for better security.

## Tech Stack

**Frontend:** Laravel Blade Engine

**Backend:** Laravel

**Database:** MySQL

**Authentication:** JWT or Sanctum

## Run Locally

Clone the project

~~~bash
git clone https://github.com/Sleepy4k/laravel-invfest-registration.git
~~~

Go to the project directory

~~~bash
cd laravel-invfest-registration
~~~

Install composer dependencies

~~~bash
composer install
~~~

Or, if you are in production mode run this command

~~~bash
composer install --no-dev
~~~

Run pre-setup command

~~~bash
php artisan naka:pre-setup
~~~

Migrate database table and data seeder

~~~bash
php artisan migrate --seed
~~~

Add storage symlink into public path

~~~bash
php artisan storage:link
~~~

Start the server

~~~bash
composer run dev
~~~

## Notes

- Pre Setup Error

To solve this error you need to run pre setup command.
copy command below and paste it on your terminal.

~~~bash
php artisan naka:pre-setup
~~~

- Lack of Performance

If your website seems laggy, or time to load content is slow as hell.
run this command and dont forget to clear all cache before.

~~~bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
~~~

- Storage symlink failed

When you deploy this on cpanel or similar, you need to change index.php base path,
after that, you can change storage link path on `config/filesystems.php`, scroll to bottom of config,
and change path, for example

~~~bash
'links' => [
    public_path('../../public_html/storage') => storage_path('app/public'),
],
~~~

- Migration Error (SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes)

This happen when laravel default charset is different from database charset, i met this error before because of database server using `InnoDB`,
which mean it use latin1 charset, and max of string only 125 or 191 character, to fix this change your migration engine on `config/database.php`, scroll into connections list, and change your drive engine and set into `InnoDB`, for example

~~~bash
'engine' => 'InnoDB',
~~~

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`APP_NAME`
`APP_KEY`
`APP_URL`
`APP_DEBUG`
`APP_ENV`

`DB_CONNECTION`
`DB_HOST`
`DB_DATABASE`
`DB_USERNAME`
`DB_PASSWORD`

`MAIL_MAILER`
`MAIL_HOST`
`MAIL_PORT`
`MAIL_USERNAME`
`MAIL_PASSWORD`
`MAIL_ENCRYPTION`
`MAIL_FROM_ADDRESS`

## Acknowledgements

- [Laravel](https://laravel.com/docs/11.x)
- [MySQL](https://dev.mysql.com/doc)
- [Content Security Policy](https://github.com/spatie/laravel-csp)

## Feedback

If you have any feedback, please make an issue with detail description, proof of concept, and composer dependencies list
