Introduction
------------
This is a lightweight Laravel package designed to streamline the process of creating repositories design pattern in your projects. With this package, you can effortlessly generate the necessary files for your repository, including the concrete class, interface, and service provider.

Installation
------------
Copy the following into your composer.json file
```bash
  "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Sagni-prog/LaravelRepositoryGenetator.git"
        }
    ],
```

After copying your composer.json will be something like this
```bash

{
    "name": "laravel/laravel",
    "type": "project",
    "description": "The Laravel Framework.",
    "keywords": ["framework", "laravel"],
    "license": "MIT",
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Sagni-prog/LaravelRepositoryGenetator.git"
        }
    ],
    "require": {
        "php": "^8.0",
        "fruitcake/laravel-cors": "^2.0.5",
        "guzzlehttp/guzzle": "^7.2",
        "laravel/framework": "^9.0",
        "laravel/sanctum": "^2.14",
        "laravel/tinker": "^2.7",
        ...
    },
```
    
    then run the following command
    
```bash
composer require sagni/repository
```

Usage
----------------
```bash
php artisan make:repository User/UserRepository
```

After runnig the command the following files will be created in your project 

```php
   <?php

namespace App\Repositories\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{
 
 public function __construct(){
     
   }
   
   
}
```

```php
<?php

namespace App\Repositories\User;

Interface UserRepositoryInterface{

  
}
```

```php
<?php

namespace App\Repositories\User;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;


class UserRepositoryServiceProvider extends ServiceProvider{
   
   public function register(){
   
      $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
   }
   
   public function boot(){
   
   }
}
```
And the following will be added in your project's config/app.js

```php
App\Repositories\User\UserRepositoryServiceProvider::class,
```
