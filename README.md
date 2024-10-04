# Trucks
 Truck management API powered by Laravel 11 API
## Prerquisties
PHP 8.2 or 8.3, recommended Laragon or other localhost alternatives (WAMP or XAMPP) 
1. Clone repository
2. Change directory to front-accordion in terminal ```cd back-end-accordion```
3. Install composer back-end dependencies - ```composer install```
4. Copy .env file from example to local/prod and testing envs ```cp .env.example .env``` ```cp .env.example .env.testing```
5. Insert your prefered DB credentials to .env and .env.testing file respectively or use Sqlite default one
6. Run ```php artisan key:generate```
7. Run ```php artisan migrate```. If you want test data run ```php artisan migrate --seed``` 
8. Laragon users: just launch Laragon (projects are started for you by default). Other localhost providers you must run ```php artisan serve``` command to launch the server