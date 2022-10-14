# Ecommerce Application
> this is ecommerce app (still under construction) built with angular2, phalcon and mysql

## Run on your local machine
phalcon: <br />
 > https://docs.phalcon.io/5.0/fr-fr/installation <br />

Angular:<br />
``` npm install -g @angular/cli ``` <br />

Mysql:<br />
> https://dev.mysql.com/downloads/installer <br />

some additional configurations maybe required <br />

## Run on Docker
clone the project <br />
``` git clone https://github.com/TheAlg/EcomApp.git  && cd EcommApp```<br />

build containers<br />
 ```docker-compose up --buil```<br />

run phinx migration<br />
``` docker-compose exec backend php vendor/bin/phinx migrate ```<br />

run phinx seed<br />
``` docker-compose exec backend php vendor/bin/phinx seed:run ``` <br />

to stop application<br />
``` docker-compose down ``` <br />

### Note
docker compose might take some time building images
if so, give it some more time: <br />
``` export DOCKER_CLIENT_TIMEOUT=120 ```
