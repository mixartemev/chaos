## Init

cp .env.example .env
sudo chmod -R 777 storage bootstrap/cache
php artisan key:generate

php artisan make:model Project -mr
php artisan make:model Task -mr
