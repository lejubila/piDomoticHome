# Publicaction public resource
php artisan vendor:publish --provider="Lejubila\PiDomoticHome\ExampleModule\ExampleModulePiDHServiceProvider" --tag="public"

# Permission seeder
php artisan db:seed --class="Lejubila\PiDomoticHome\ExampleModule\src\database\seeds\PermissionSeeder"