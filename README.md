### Installation
 1. requires docker
 2. docker-compose up -d
 3. server should be started at `localhost:9000`. If you would like to connect to the MySQL database directly, you can do so
 using the credentials: 
    - server:  `localhost`
    - port:  `9306`
    - user:  `root`
    - password: `Qp057726W4O1A5RAg7096025141bjc5g`
 4. run migration script `docker exec app php bin/console doctrine:migrations:migrate`

________________________

### Tasks
 1. Ingestion Layer
  - for each time you want to ingest 5 minutes, run `docker exec app php bin/console doctrine:fixtures:load`
  - since this is a very simple script, duplication for minutes will likely occur if executed concurrently
 2. Rest API
 - 

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
