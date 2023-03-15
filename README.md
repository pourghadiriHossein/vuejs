## Create Server Database And Seeder

## <a href="https://spatie.be/docs/laravel-permission/v5/installation-laravel">Install Spatie Laravel Permission</a>
- ### Install Spatie
```bash
composer require spatie/laravel-permission
```
- ### Add To providers Array in config\app.php File
```bash
Spatie\Permission\PermissionServiceProvider::class,
```
- ### Create Migartions
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```
- ### Clear Config
```bash
php artisan config:clear
```
- ### Add to User Use
```bash
HasRoles
```

## <a href="https://laravel.com/docs/9.x/passport">Set Laravel Passport For Project</a>
- ### Installation
```bash
composer require laravel/passport
```
- ### Migaret Table
```bash
php artisan migrate
```
- ### Command For Create the Encryption Keys
```bash
php artisan passport:install
```
- ### Add AUTH_WEB_CLIENT_ID and AUTH_WEB_CLIENT_SECRET in .env file
```bash
AUTH_WEB_CLIENT_ID=
AUTH_WEB_CLIENT_SECRET=
```
- ### Add HasApiTokens to User Model
```bash
<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
 
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
}
```

- ### Update Guard Part in config/auth.php
```bash
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
 
    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
```

- ### Passport::loadKeysFrom in App\Providers\AuthServiceProvider
```bash
use Laravel\Passport\Passport;

public function boot()
{
    $this->registerPolicies();
 
    Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
}
```
- ### Create secrets Folder in App Directory then Create oauth Folder in secrets Folder

- ### Loading Keys
```bash
php artisan passport:keys
```

- ### Config Customization
```bash
php artisan vendor:publish --tag=passport-config
```

- ### Migration Customization
```bash
php artisan vendor:publish --tag=passport-migrations
```


        
## Create Oauth Seeder and Complete 

## Create Enum For Project

## Create Permission Seeder

## Create User Seeder

## Create Post Model and Migration

## Create UpVote Model and Migration

## Create Media Model and Migration

## Create model has media Migration
