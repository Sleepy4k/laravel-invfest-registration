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

- Composer installation Error

If you met installation error with message `need github token` or `permissions are sufficient for this personal access token`,
then you need to generate your github personal access token on `https://github.com/settings/tokens`, and make sure to checklist
`read:packages` permission, and generate token, and paste on token input after type your github username, token example

~~~bash
ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxx
-------------------------------
github_pat_xxxxxx_xxxxxxxxxxxxx
~~~

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

- Notification won't sent to user

Keep in mind that default system using queue for jobs, that's mean when user register they need to wait until jobs is clear,
but if your system don't setup any cron job or using InnoDB (they can't load jobs database), so you need to disable on notification class,
just remove `implements ShouldQueue` from current class so it will be like this,

~~~bash
class TeamRejected extends Notification
~~~

and if you want to activated notification jobs then change again to

~~~bash
class TeamRejected extends Notification implements ShouldQueue
~~~

## Security Things

- Content Security Policy (CSP)

For any reasons please don't turn on this feature, because we are implementing danger rendering on blade,
so for security issue, keep enable this feature, if you met any error such as script blocked or something,
read article about how to setting up CSP, so you can handle this error

- User Session

When this web deployed, please change session setting on `config/session.php`, keep in mind out main goal
is to secure user data, so follow this config for better session security,

~~~bash
'encrypt' => env('SESSION_ENCRYPT', true)
'secure' => env('SESSION_SECURE_COOKIE', true),
~~~

- Secure Header

After all feature implemented, you can change secure heade config for better security,
so set HTTP Strict Transport Security config (force into https protocol), so it will be like this

~~~bash
'hsts' => [
    'enable' => true,

    'max-age' => 31536000,

    'include-sub-domains' => false,

    'preload' => true,
],
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
