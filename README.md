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
                    Set api Guard for passport in config/auth.php
                </li><br>
                <br><li>
                    Add Passport Load Key of Deploying Passport on Auth Service Provider
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
                <br><li>
                    Set Client ID and Client Secret Key in .ENV
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
            Create Post Model and Migartion
        </li>
        <li>
            Create UpVote Model and Migartion
        </li>
        <li>
            Create Media Model and Migartion
        </li>
        <li>
            Create model has media Migartion
        </li>
    </ol>
