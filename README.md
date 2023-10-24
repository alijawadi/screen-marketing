# git
    git branch branch_name
    git checkout branch_name
    git push --set-upstream origin branch_name
    git fetch --all

# URL:
    https://apisscreen.selectedstartups.com/api
    https://apisscreen.selectedstartups.com:9009/.well-known/mercure

# local installation:
    docker-compose build
    docker-compose up --build
    docker-compose up
    docker-compose down
    docker-compose down -v
    docker-compose ps
    docker-compose ps -a
    docker exec -it screen-apis-php /bin/bash
        apt update -y
        apt upgrade -y
        apt install npm nano -y
        composer install
        npm install
        php artisan db:wipe
        php artisan migrate:fresh
        php artisan migrate
        php artisan migrate:rollback
        php artisan db:seed
        id
        ls -l /path/
        chmod -R u=rwx,g=rwx,o=rwx /path/
        docker cp screen-api-php:/var/www/vendor d:\vendor







### Serving The Project using [Laravel Sail](https://laravel.com/docs/10.x/sail)

ali javadi

mercure
caddy

nginx

<span style="color: #c66060; font-size: 30px;"> Important: Don't use sail for production </span>

### 1. Install dependencies using composer: 

```shell
composer install
```

### 2. Migrate the Database
```shell
./vendor/bin/sail artisan migrate
```
Add alias for sail to easily write commands:

```shell
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

### 3. Update the ENV DB Variables to the following
```dotenv
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### 4. Use Sail to serve the application

```shell
sail up -d
```

Then you should be able to see an api documentation in this route: ``/docs/api``
