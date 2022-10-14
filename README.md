# Ecommerce Application
> this is ecommerce app (still under construction) built with angular2, phalcon and mysql

## run on your local machine
phalcon : 
> https://docs.phalcon.io/5.0/fr-fr/installation
angular :
``` npm install -g @angular/cli ```
mysql : 
> https://dev.mysql.com/downloads/installer/

some additional configurations maybe required

## using Docker
clone the project
``` git clone https://github.com/TheAlg/EcomApp.git  && cd EcommApp```

build containers
 ```docker-compose up --buil```

run phinx migration
``` docker-compose exec backend php vendor/bin/phinx migrate ```

run phinx seed
``` docker-compose exec backend php vendor/bin/phinx seed:run ``` 

to stop application
``` docker-compose down ``` 

### note
docker compose might take some time building images
if so, give it some more time :
``` export DOCKER_CLIENT_TIMEOUT=120 ```
