## Table of Contents

- [Overview](#overview)
- [Installation](#installation)
    - [Requirements](#requirements)
    - [Install the Package](#install-the-package)
- [Usage](#usage)

## OverView

This is a lightweight Laravel package designed to streamline the process of creating repositories design pattern in your projects. With this package, you can effortlessly generate the necessary files for your repository, including the concrete class, interface, and service provider.

## Installation

### Requirements
The package has been developed and tested to work with the following minimum requirements:

- PHP 8.0
- Laravel 8

### Install the Package
Run this command

```bash
composer require sagni/repository
```



## Usage

```bash
php artisan make:repository User/UserRepository
```

After runnig the command the following files will be automatically created in your project 

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
And the following will be automatically added in your project's config/app.php

```php
App\Repositories\User\UserRepositoryServiceProvider::class,
```
