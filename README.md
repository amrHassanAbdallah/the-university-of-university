# the university of university

### Prerequisites

What you need to setup your local dev environment

```
Git
Composer
php (^7.1.3 version to run composer)
```

### Installing

A step by step to get a development env running

Clone repository

```
git clone https://gitlab.com/amrHassanAbdallah/private-area.git
```

cd to repo

```
cd the-university-of-university
```

Copy .env.example to .env 

```
cp .env.example .env 
```

Change the DB_DATABASE, DB_USERNAME & DB_PASSWORD to match the database details on your system (mysql configuration )

Then install Dependencies 

```
composer install
```

make sure to migrate and seed the db
```
php artisan migrate

php artisan db:seed
```

