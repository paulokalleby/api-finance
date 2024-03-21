# Finance API with laravel

## How to run the project

Clone the project
```sh
git clone git@github.com:paulokalleby/api-finance.git
```
```sh
cd api-finance
```

Upload project containers

```sh
./vendor/bin/sail up -d
```

Install project dependencies
```sh
./vendor/bin/sail composer i
```

Generate the Laravel project key
```sh
./vendor/bin/sail artisan key:generate
```

Run migration and popular user table with seeder
```sh
./vendor/bin/sail artisan migrate --seed
```

Access project documentation
[http://localhost](http://localhost)
