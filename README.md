# Project Overview
This project aims to provide a platform for managing and tracking orders. It includes features for storing order data, calculating total costs, and monitoring order execution status. The application utilizes Laravel, and integrates Docker for easy deployment and management of the development environment.

Ensure you execute these commands within the project directory and have Docker installed and properly configured on your system. Following these instructions will help set up the environment and run the project effectively.

# Instructions for Execution

## Follow these steps to set up and run the project:

### Run the following commands in your terminal:
    docker compose -up -d
    docker exec -it beeping-app php artisan optimize
    docker exec -it beeping-app php artisan key:generate
    docker exec -it beeping-app php artisan migrate
    docker exec -it beeping-app php artisan db:seed
    docker exec -it beeping-app php artisan horizon:install

### Execute the following command in a separate terminal window to run Horizon:

    docker exec -it beeping-app php artisan horizon

### Run the following command in another terminal window to execute the scheduler:

    docker exec -it beeping-app php artisan schedule:run

Verify this message after running 'schedule:run'

    Running ['artisan' execute:total] ............ 13,607ms DONE
      ⇂ '/usr/local/bin/php' 'artisan' execute:total > '/dev/null' 2>&1  

### Check if the scheduler is running by executing the following command in a different terminal window:

    docker exec -it beeping-app php artisan schedule:list
    
### Execute the endpoint test by running the following command:

    docker exec -it beeping-app php artisan test --filter ExecutedControllerTest

### Access localhost:82 in your browser to view the list of orders.
