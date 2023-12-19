# Installation && Setup
```
cp .env.example .env
```

Installing Composer Dependencies
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Starting & Stopping Sail
```
 ./vendor/bin/sail up -d
 
 ./vendor/bin/sail down
```

Generate APP key
```
./vendor/bin/sail artisan key:generate
```

Once the application's containers have been started, you may access the project in your web browser at: http://localhost.
