# Publication of the configuration
php artisan vendor:publish --provider="Lejubila\PiDomoticHome\PiDomoticHomeServiceProvider" --tag="config"

# Publication of the public resources
php artisan vendor:publish --provider="Lejubila\PiDomoticHome\PiDomoticHomeServiceProvider" --tag="public"