# bellpi Hub de Usuarios

Este paquete permite enlazar usuarios en diferentes plataformas administradas por bellpi y asi evitar multiples creaciones de cuentas y contraseñas.

## Dependencias requeridas

Antes de instalar este paquete debe instalar laravel/ui

Laravel 6.0

```bash
composer require laravel/ui:^1.0 --dev
```


Laravel 7.0

```bash
composer require laravel/ui
```
Luego de estar instalado ejecute cualquiera de estos tres comandos 
```bash
 php artisan ui bootstrap
 php artisan ui vue
 php artisan ui react
```
## Instalación

Use el composer manager para instalar este paquete.

```bash
composer require magdalenamedio/hub-users-package
```
Configure en el .env en las siguientes variables de entorno; los valores se modificaran de acuerdo a los valores que el administrador de base de datos le suministre:

```bash
DB_URL_HUB=
DB_DRIVER_HUB=mysql
DB_HOST_HUB=127.0.0.1
DB_PORT_HUB=3306
DB_DATABASE_HUB=hub_users
DB_USERNAME_HUB=root
DB_PASSWORD_HUB=
DB_SOCKET_HUB=
DB_CHARSET_HUB=utf8mb4
DB_COLLATION_HUB=utf8mb4_unicode_ci
DB_PREFIX_HUB=
DB_PREFIX_IND_HUB=true
DB_STRICT_HUB=true
DB_ENGINE_HUB=null
```
Agrege en su raiz del proyecto en el directorio config.database el siguiente array.
```bash
 
        'hub_users' => [
            'driver' => env('DB_DRIVER_HUB'),
            'url' => env('DB_URL_HUB'),
            'host' => env('DB_HOST_HUB'),
            'port' => env('DB_PORT_HUB'),
            'database' => env('DB_DATABASE_HUB'),
            'username' => env('DB_USERNAME_HUB'),
            'password' => env('DB_PASSWORD_HUB'),
            'unix_socket' => env('DB_SOCKET_HUB'),
            'charset' => env('DB_CHARSET_HUB'),
            'collation' => env('DB_COLLATION_HUB'),
            'prefix' => env('DB_PREFIX_HUB'),
            'prefix_indexes' => env('DB_PREFIX_IND_HUB'),
            'strict' => env('DB_STRICT_HUB'),
            'engine' => env('DB_ENGINE_HUB'),
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
```
Luego de estar instalado el paquete ejecute
```bash
php artisan vendor:publish
```

Elija las siguientes opciones de publicacion del hub de usuarios
``` bash
  [xx] Tag: hub-users-assets
  [xx] Tag: hub-users-config
  [xx] Tag: hub-users-models
  [xx] Tag: hub-users-views
```
Verifique en  su raiz de proyecto y en el directorio routes.web que las siguientes rutas no esten habilitadas

```bash
Auth::routes(),
Route::get('/home', 'HomeController@index')->name('home');
```
En caso contrario debe comentarlas o cambiarles el nombre a estas rutas para que el paquete funcione correctamente.

## Uso 
Diríijase a la siguiente url de host del proyecto http://example.test/login

Si ya ha sido notificado por el administrador del paquete con su usuario y contraseña puede acceder con estas configuraciones previamente hechas.

## License
[MIT](https://choosealicense.com/licenses/mit/)
