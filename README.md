### Serving The Project using [Laravel Sail](https://laravel.com/docs/10.x/sail)

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
