# Installation && Setup
1. Clone the repository and into to directory.
   ```sh
   git clone git@github.com:r3nyou/devmentor-BE103-PHP.git && cd devmentor-BE103-PHP
   ```

2. Install Composer vendor directory and [Laravel Sail](https://laravel.com/docs/10.x/sail). This step uses Laravel Sail PHP 8.2 image with preinstalled Composer to install all dependencies.
   ```sh
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v "$(pwd):/var/www/html" \
       -w /var/www/html \
       laravelsail/php82-composer:latest \
       composer install --ignore-platform-reqs && cp -n .env.example .env
   ```

3. Start the container and enerate application key (via Laravel Sail).
   ```sh
   cd src && vendor/bin/sail up -d && vendor/bin/sail artisan key:generate
   ```

Once the application's containers have been started, you may access the project in your web browser at: http://localhost.
   > For more information, view the document for [Laravel Sail](https://laravel.com/docs/10.x/sail) and Docker.

