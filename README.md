
# About HelpDesk API
First of all thank you for giving me this opportunity, means a lot to me.

This application has been developed in a WSL environment.

## Prerequisites

Make sure you have PHP, Composer, and Docker installed on your computer. Sail uses Docker to set up the development environment.

Ensure you have Git installed for version control (optional but recommended).

## Configuration
This application comes with Laravel Sail inside. So after successfully clone the app

### Install all dependencies


```bash
composer install
```

### Initialize Sail

Initialize the Laravel Sail environment by running the following command in the root of your Laravel project:

```bash
php artisan sail:install

```


### Start Docker Containers:

Sail uses Docker to run the development environment. To start the Docker containers, run the following command:


```bash
./vendor/bin/sail up

```

### Migrate and seed:
The database will come with basic data

```bash
./vendor/bin/sail artisan migrate:fresh --seed

```

### Access the Application:

Once the containers are up and running, you can access your Laravel application at http://localhost.

For testing in postman use the the employee user
```
employee.user@mail.com
password

```


For testing in postman use the the regular user
```
regular.user@mail.com
password

```

# Endpoints

The Endpoints documentation is available in the following link

https://documenter.getpostman.com/view/7413633/2s9YJgULiz
# Recommendation

If any issue arises, please do not hesitate to contact me for clarifications

