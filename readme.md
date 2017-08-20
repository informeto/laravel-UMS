## CSV UMS
Laravel based User management system for maintaining user registrations and records.

## Installation
Please ensure you have installed php5.6 in your system.

Clone the repository
```
git clone https://github.com/pushpann/laravel-UMS.git
```

Install the dependencies:

```
php composer.phar install
```

Generate laravel environment:

```
cp .env.example .env
php artisan key:generate
php artisan cache:clear
```

Create link to local file storage(for storing in CSV file(storage/data/registrations.csv))
```
php artisan storage:link
```



Run the server

```
php artisan serve
```

Open the client 
```
http://localhost:8000

```