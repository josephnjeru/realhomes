# realhomes
#create .env file
cp .env.exmple .env

#Generate laravel application key
php artisan key:generate

#configure you database under .env file

#create db table from migrations
php artisan migrate

#serve your project to port 8000
 php artisan serve

#navigate to localhost:8000