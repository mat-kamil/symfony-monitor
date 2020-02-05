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
    - API consists of getting one endpoint, `api/server-load` with optional parameters `from` and `to`, which are ISO dates
 3. Web Page
    - I built the web page to show a chart and using some custom javascript to load everything in.
    - I used chartjs, moment & axios to facilitate me in the code.
    - TODO: i could not finish the website due to and error occurring, the composer project would not respond, 
    no matter what i did. I have therefore taken the decision to submit my app as-is.
 

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
