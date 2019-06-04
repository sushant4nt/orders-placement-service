# Orders Placement Service

## Requirements

- Docker & Docker Compose 3
- PHP >= 7.0
- MySQL >= 5.7


## Features

- #### Create Orders API
  - You can place using by providing origin and destination
  - Response: 200 OK - an object containing the distance and the order ID
  - Route: http://localhost:8080/orders
    Method: POST
    Request:
      ```
      {
        "origin": ["START_LATITUDE", "START_LONGTITUDE"],
        "destination": ["END_LATITUDE", "END_LONGTITUDE"]
      }
      ```
      Response:
      ```
      {
        "id": <order_id>,
        "distance": <total_distance>,
        "status": "UNASSIGN"
      }
      ```

- #### Take Orders API
  - API to take orders by specifying the order ID
  - An order can only be taken once
  - Route: http://localhost:8080/orders/:id
    Method: PUT
    Request:
    ```
    {
       "status":"taken"
    }
    ```
    Response:
    ```
    {
       "status": "SUCCESS"
    }
    ```
- #### List Orders API
  - List all the orders in a paginated manner
  - Specify page and limit to retrieve orders
    Route: http://localhost:8080/orders?page=:page&limit=:limit
    Method: GET
    Response:
    ```
    [
     {
        "id": <order_id>,
        "distance": <total_distance>,
        "status": <ORDER_STATUS>
     },
     ...
    ]
    ```
- Google Map API for `GoogleDistanceMatrix`
- Proper Validations
- Tests with `phpunits`
- Migrations and auto execution
- Composer
- Docker Containers for Setting up application
- start.sh bash script for deployment
- Will work with port 8080, as required


## Setup Application

- Setup Docker and Docker Compose (Prerequisite)
- Execute bash script

> ./start.sh

or 

> bash start.sh


## Run Unit Tests from Container

> docker exec -i workspace ./vendor/bin/phpunit tests/


## Configuration Files:

- Google Map API Key: `config/app.php` param `google_maps_api_key`
- Database Config: `.env` file contains all database information and environment variables

> Note: I have added google map api, after sometime will remove that from account.