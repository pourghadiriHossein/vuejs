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

- ### Deploying Passport
```bash
php artisan passport:keys
```

- ### Passport::loadKeysFrom in App\Providers\AuthServiceProvider
```bash
public function boot()
{
    $this->registerPolicies();
 
    Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
}
```
- ### Loading Keys From The Environment
```bash
php artisan vendor:publish --tag=passport-config
```
- ### Migration Customization
```bash
php artisan vendor:publish --tag=passport-migrations
```

<ol>
        <li>
            <a href="https://laravel.com/docs/9.x/passport">
              Set Laravel Passport For Project
            </a>
            <ul>
                <br><li>
                    composer require laravel/passport
                </li><br>
                <br><li>
                    php artisan vendor:publish --tag=passport-migrations
                </li><br>
                <br><li>
                    php artisan passport:install
                </li><br>
                <br><li>
                    Set Client ID and Client Secret Key in .ENV
                </li><br>
                <br><li>
                    Set api Guard for passport in config/auth.php
                    <br><ol>
                    <li>
                        'api' => [<br>
                             'driver' => 'passport',<br>
                             'provider' => 'users',<br>
                         ],<br>
                    </li>
                    </ol><br>
                </li><br>
                <br><li>
                    Add Passport Load Key of Deploying Passport on AuthServiceProvider.php boot
                </li><br>
                <br><li>
                    Create secrets Folder in App Directory then Create oauth Folder in secrets Folder
                </li><br>
                <br><li>
                    php artisan passport:keys 
                </li><br>
                <br><li>
                    Create Oauth Seeder and Complete 
                </li><br>
            </ul>
        </li><br>
        <li>
            <a href="https://spatie.be/docs/laravel-permission/v5/installation-laravel">
                Installation Spatie ACL in Laravel
            </a>
            <ul>
                <br><li>
                    composer require spatie/laravel-permission
                </li><br>
                <br><li>
                    app/config.php <br><br>
                    'providers' => [<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// ... <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Spatie\Permission\PermissionServiceProvider::class,<br>
                    ];
                </li><br>
                <br><li>
                    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
                </li><br>
                <br><li>
                    Create Enum For Project
                </li><br>
                <br><li>
                    Create Permission Seeder
                </li><br>
                <br><li>
                    Use HasRoles for User Model 
                </li><br>
                <br><li>
                    Create User Seeder
                </li><br>
            </ul>
        </li><br>
        <li>
            Create Post Model and Migration
        </li>
        <li>
            Create UpVote Model and Migration
        </li>
        <li>
            Create Media Model and Migration
        </li>
        <li>
            Create model has media Migration
        </li>
    </ol>
