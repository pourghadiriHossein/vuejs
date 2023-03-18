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


## Create Post Model and Migration
- ### Create Post Model and Migration Command
```bash
php artisan make:model Post -m
```
- ### Model
```bash
use HasFactory, SoftDeletes;

protected $fillable = [
    'title',
    'description',
    'up_vote_count',
    'location'
];

public function user() {
    return $this->belongsTo(User::class);
}

public function votes() {
    return $this->hasMany(UpVote::class);
}

public function media() {
    return $this->morphToMany(Media::class, 'model', 'model_has_media');
}
```
- ### Migration
```bash
$table->id();
$table->unsignedBigInteger('user_id');
$table->string('title', 250);
$table->text('description')->nullable();
$table->point('location')->nullable();
$table->unsignedInteger('up_vote_count')->default(0);
$table->timestamps();
$table->softDeletes();

$table->foreign('user_id')
    ->references('id')
    ->on('users');
```

## Create UpVote Model and Migration
- ### Create UpVote Model and Migration Command
```bash
php artisan make:model UpVote -m
```
- ### Model
```bash
use HasFactory;
/**
 * The primary key associated with the table.
 *
 * @var string
 */
/**
 * Indicates if the IDs are auto-incrementing.
 *
 * @var bool
 */
public $incrementing = false;

public function user() {
    return $this->belongsTo(User::class);
}

public function post() {
    return $this->belongsTo(Post::class);
}

/**
 * The "booting" method of the model.
 *
 * @return void
 */
protected static function boot()
{
    parent::boot();
    UpVote::created(function(UpVote $upVote) {
        $post = $upVote->post;
        $post->increment('up_vote_count', 1);
        $post->save();
    });
    UpVote::deleted(function(UpVote $upVote) {
        $post = $upVote->post;
        $post->decrement('up_vote_count', 1);
        $post->save();
    });
}
```
- ### Migration
```bash
$table->id();
$table->unsignedBigInteger('user_id');
$table->unsignedBigInteger('post_id');
$table->timestamps();

$table->unique(['user_id', 'post_id']);
$table->foreign('user_id')
    ->references('id')
    ->on('users');
$table->foreign('post_id')
    ->references('id')
    ->on('posts');
```

## Create Media Model and Migration
- ### Create Media Model and Migration Command
```bash
php artisan make:model Media -m
```
- ### Model
```bash
use HasFactory;

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = ['size', 'mime_type', 'url'];

public function user() {
    return $this->belongsTo(User::class);
}
```
- ### Migration
```bash
$table->id();
$table->unsignedBigInteger('user_id');
$table->unsignedInteger('size')->default(0);
$table->text('mime_type')->nullable();
$table->text('url')->nullable();
$table->timestamps();

$table->foreign('user_id')
    ->references('id')
    ->on('users');
```

## Create model has media Migration
- ### Create Post Model and Migration Command
```bash
php artisan make:migration create_model_has_media_table
```
- ### Migration
```bash
$table->id();
$table->unsignedBigInteger('model_id');
$table->text('model_type');
$table->unsignedBigInteger('media_id');
$table->timestamps();
```

## Create Enum Folder in app For Project
- ### Create Permissions.php file
```bash
<?php

namespace App\Enum;

final class Permissions {
    public const VIEW_MY_PROFILE = 'view my profile';
    public const UPDATE_MY_ACCOUNT = 'update my account';

    public const VIEW_ANY_POST = 'view any post';
    public const LIKE_ANY_POST = 'like any post';

    public const CREATE_NEW_POST = 'create new post';
    public const UPDATE_MY_POST = 'update my post';
    public const DELETE_MY_POST = 'delete my post';

    public const UPDATE_ANY_POST = 'update any post';
    public const DELETE_ANY_POST = 'delete any post';

    public const VIEW_ANY_ACCOUNT = 'view any account';
    public const CREATE_ANY_ACCOUNT = 'create any account';
    public const UPDATE_ANY_ACCOUNT = 'update any account';
    public const DELETE_ANY_ACCOUNT = 'delete any account';
}
```
- ### Create Roles.php
```bash
<?php

namespace App\Enum;

final class Roles {
    public const ADMIN = 'admin';
    public const USER = 'user';
}
```
        
## Create Oauth Seeder and Complete 
```bash
Client::create([
    'name' => 'Web Client',
    'id' => env('AUTH_WEB_CLIENT_ID',1),
    'secret' => env('AUTH_WEB_CLIENT_SECRET'),
    'redirect' => 'localhost:8000',
    'provider' => 'users',
    'personal_access_client' => 0,
    'password_client' => 1,
    'revoked' => 0,
]);
```

## Create Permission Seeder
```bash
$admin = Role::create(['name' => Roles::ADMIN, 'guard_name' => 'api']);
$user = Role::create(['name' => Roles::USER, 'guard_name' => 'api']);

Permission::create(['name' => Permissions::VIEW_MY_PROFILE, 'guard_name' => 'api']);
Permission::create(['name' => Permissions::UPDATE_MY_ACCOUNT, 'guard_name' => 'api']);

Permission::create(['name' => Permissions::VIEW_ANY_POST, 'guard_name' => 'api']);
Permission::create(['name' => Permissions::LIKE_ANY_POST, 'guard_name' => 'api']);

Permission::create(['name' => Permissions::CREATE_NEW_POST, 'guard_name' => 'api']);
Permission::create(['name' => Permissions::UPDATE_MY_POST, 'guard_name' => 'api']);
Permission::create(['name' => Permissions::DELETE_MY_POST, 'guard_name' => 'api']);

Permission::create(['name' => Permissions::UPDATE_ANY_POST, 'guard_name' => 'api']);
Permission::create(['name' => Permissions::DELETE_ANY_POST, 'guard_name' => 'api']);

Permission::create(['name' => Permissions::VIEW_ANY_ACCOUNT, 'guard_name' => 'api']);
Permission::create(['name' => Permissions::CREATE_ANY_ACCOUNT, 'guard_name' => 'api']);
Permission::create(['name' => Permissions::UPDATE_ANY_ACCOUNT, 'guard_name' => 'api']);
Permission::create(['name' => Permissions::DELETE_ANY_ACCOUNT, 'guard_name' => 'api']);

$admin->givePermissionTo(Permissions::VIEW_MY_PROFILE);
$admin->givePermissionTo(Permissions::UPDATE_MY_ACCOUNT);

$admin->givePermissionTo(Permissions::VIEW_ANY_POST);
$admin->givePermissionTo(Permissions::LIKE_ANY_POST);

$admin->givePermissionTo(Permissions::CREATE_NEW_POST);
$admin->givePermissionTo(Permissions::UPDATE_MY_POST);
$admin->givePermissionTo(Permissions::DELETE_MY_POST);

$admin->givePermissionTo(Permissions::UPDATE_ANY_POST);
$admin->givePermissionTo(Permissions::DELETE_ANY_POST);

$admin->givePermissionTo(Permissions::VIEW_ANY_ACCOUNT);
$admin->givePermissionTo(Permissions::CREATE_ANY_ACCOUNT);
$admin->givePermissionTo(Permissions::UPDATE_ANY_ACCOUNT);
$admin->givePermissionTo(Permissions::DELETE_ANY_ACCOUNT);

$user->givePermissionTo(Permissions::VIEW_MY_PROFILE);
$user->givePermissionTo(Permissions::UPDATE_MY_ACCOUNT);

$user->givePermissionTo(Permissions::VIEW_ANY_POST);
$user->givePermissionTo(Permissions::LIKE_ANY_POST);

$user->givePermissionTo(Permissions::CREATE_NEW_POST);
$user->givePermissionTo(Permissions::UPDATE_MY_POST);
$user->givePermissionTo(Permissions::DELETE_MY_POST);
```

## Create User Seeder
```bash
$user = User::create([
    'name' => 'حسین پورقدیری',
    'email' => 'hossein.654321@yahoo.com',
    'password' => Hash::make('123456')
]);
$user->assignRole(Role::findByName(Roles::ADMIN, 'api'));
```

## Update DatabaseSeeder.php
```bash
$this->call([
    OauthClinetSeeder::class,
    PermissionSeeder::class,
    UserSeeder::class,
]);
```
## Update config/cors.php file
```bash
'paths' => ['api/*', 'sanctum/csrf-cookie', 'oauth/token'],

'allowed_methods' => ['*'],

'allowed_origins' => ['*'],

'allowed_origins_patterns' => [],

'allowed_headers' => ['*'],

'exposed_headers' => [],

'max_age' => 0,

'supports_credentials' => true,
```
