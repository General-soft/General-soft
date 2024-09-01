# About

Test project to validate a issued file using customizable logic. It supports only validation of json files.

# Requirements

Recommended to use linux with bash shell. Otherwise, makefile commands may not work.

* docker
* docker compose

# Start project

Create .env file as a copy .env.example file. Default configuration for .env file should work. 
Please ensure that ports `80` and `5433` are not taken. Ports can be changed in .env file `WEB_LOCAL_PORT`, `POSTGRESS_LOCAL_PORT`.

Project uses docker environment to run locally. To run docker containers run `make setup`.

Other useful commands to interact with containers:
* `make down` - stop containers
* `make up` - start containers
* `make restart` - restart containers

Run `make api-docs` to generate api documentation. After starting the project documentation can be accessible using `http://localhost/api/documentation` url.

# Testing

After starting project several containers should be up. 
Using database management tool of your choice access database on `localhost:5433` and create `validator_test` database.

After that run `make test`.

To generate coverage run either `make coverage` to generate coverage report in console

To generate html report run `make coverage-report` and then access `coverage/index.html`.


