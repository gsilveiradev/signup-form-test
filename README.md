# Signup Form Test

## Frontend part

In this project I am using the jQuery module pattern concept. 

The base code to start and more information about this concept can be found here: [https://github.com/guissilveira/jquery-module-pattern-mvc-concept](https://github.com/guissilveira/jquery-module-pattern-mvc-concept)

### Configure

Open ```assets/js/app.js``` and configure the **api_url** param.

## Backend part

### Prerequsites

I use [Docker](https://www.docker.com) to administer this test.

### Technology

- PHP > 7.0.
- NGINX web server
- Postgres database
    - Postgres connection details:
        - host: `postgres`
        - port: `5432`
        - dbname: `signuptest`
        - username: `signuptest`
        - password: `signuptest`

### Instructions

1) Clone this repository.

2) Install and run by script (OR go to step 3)

- Install: `sh install.sh`
- Run the starter: `sh start.sh`

3) Follow these instructions (if you don't want to run the shell scripts above):

- Copy `config.env.example` to a new file called: `config.env`
- Configure the ENV params into `config.env` file
- Up the docker containers: `docker-compose up -d`
- Go to workspace container to run install commands: `docker-compose exec workspace bash`
    - Inside `workspace` container, run:
        - `composer install`
        - `vendor/bin/doctrine orm:schema-tool:update --force`
        - `vendor/bin/doctrine orm:generate-proxies`

### API Endpoints

| Method      | URL                     | Description            |
| ---         | ---                     | ---                    |
| GET         | `/`                     | Hello world!           |
| POST        | `/signup`               | Create a signup        |
| POST        | `/signup/verify_email`  | Verify email usage     |

---

### Interest stuff

Check for PSR2 standard running:

```
docker-compose exec workspace bash -c 'vendor/bin/phpcs resources src --standard=PSR2'
```

## Test

Just open the ```index.html``` on your browser.

Thank you!