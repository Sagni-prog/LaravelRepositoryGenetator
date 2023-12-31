## Table of Contents

- [Overview](#overview)
- [Installation](#installation)
    - [Requirements](#requirements)
    - [Install the Package](#install-the-package)
- [Usage](#usage)
- [Contribution](#contribution)
- [License](#license)
- [Conclusion](#conclusion)

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

### Basic Usage 

To create a repository using the make:repository command, simply run:

```bash
php artisan make:repository User/UserRepository
```

<!-- After runnig the command the following files will be automatically created in your project  -->
If the Repository directory does not exist within your app directory, the command will automatically create it for you. The above command will generate the following files:

   1. app/Repository/User/UserRepository.php
   2. app/Repository/User/UserRepositoryInterface.php
   3. app/Providers/User/UserRepositoryServiceProvider.php

If you prefer to keep the generated repository files directly in the app/Repository directory without any subdirectory, you can use the command below:

```bash
php artisan make:repository UserRepository
```
This command generates the same files mentioned above, but without the User subdirectory.




### Repository Class
After generating the necessary files, you need to implement your repository logic. Open the UserRepository.php file created inside the app/Repository/User directory and modify it as needed:

```php
   <?php

namespace App\Repositories\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{
 
 public function __construct(){
     
   }
   
   
}
```

### Repository Interface
Edit the UserRepositoryInterface.php file inside the app/Repository/User directory to define the repository methods:

```php
<?php

namespace App\Repositories\User;

Interface UserRepositoryInterface{

  
}
```
### Service Provider

The UserRepositoryServiceProvider.php file located in app/Providers/User binds the repository interface to its implementation. You don't need to modify this file, as it's automatically generated.

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
## Contribution

If you wish to make any changes or improvements to the package, feel free to make a pull request.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Conclusion

The Sagni Repository package greatly simplifies the process of creating repository classes in your Laravel application. By automating the generation of repository files, interfaces, and service providers, it encourages a structured and organized approach to data access. Feel free to expand on the base implementation to tailor it to your project's specific needs.

If you have any questions, feedback, or contributions, please don't hesitate to reach out to the package author:

- **Author:** Sagni Alemayehu
- **Email:** [sagnialemayehu69@gmail.com](mailto:sagnialemayehu69@gmail.com)

