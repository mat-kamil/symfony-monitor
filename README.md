### Installation
 1. requires docker to be installed and Hyper-V enabled
 2. run the command `docker-compose up -d` at the root of the application folder
 3. server should be started at `localhost:9000`. If you would like to connect to the MySQL database directly, you can do so
 using the credentials: 
    - server:  `127.0.0.1`
    - port:  `9306`
    - user:  `root`
    - password: `Qp057726W4O1A5RAg7096025141bjc5g`
 4. run the composer install script `docker-compose exec php composer install`
 4. run migration script `docker exec app php bin/console doctrine:migrations:migrate` to create necessary database tables

________________________

### Tasks
 1. Ingestion Layer
    - for each time you want to ingest 5 minutes, run `docker exec app php bin/console doctrine:fixtures:load --append`
    - since this is a very simple script, duplication for minutes will likely occur if executed concurrently
    - to reset the database when seeding, remove the `--append` option on the command above.
 2. Rest API
    - Build a backend application that will expose an 
    API to query the afore-ingested data in a RESTful 
    way. For example asking about the CPU load for 
    yesterday, or any time range. Feel free to build 
    the API however you think will be useful to frontend 
    in functionality.
 3. Rest API
    - Build a web page that will consume your REST API 
    and display graphs of the metrics and show the 
    average, min and max of the value for a certain 
    time range that the user can specify in the UI. 
    By default show last hours worth of data.
 

________________________

### References

#### Docker references
 - [Digital Ocean docker-compose tutorial][1]
 - [Symfony project docker][2]

#### Symfony
 - [Symfony REST tutorial][3]


[1]: https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose
[2]: https://knplabs.com/en/blog/how-to-dockerise-a-symfony-4-project
[3]: https://medium.com/q-software/symfony-5-the-rest-the-crud-and-the-swag-7430cb84cd5
