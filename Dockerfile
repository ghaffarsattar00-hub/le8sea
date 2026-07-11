# PHP ka official version use kar rahe hain
FROM php:8.4-cli

# Zaroori softwares (Node, NPM, Zip, SQLite) install kar rahe hain
RUN apt-get update && apt-get install -y git unzip sqlite3 libsqlite3-dev nodejs npm

# Composer (Laravel ka package manager) setup kar rahe hain
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Laravel aur Frontend (Tailwind) ke packages install kar rahe hain
RUN composer install --optimize-autoloader
RUN npm install && npm run build

# Database setup
RUN touch database/database.sqlite
RUN php artisan migrate --force

# Website ko live karne ka aakhri command
CMD php artisan serve --host=0.0.0.0 --port=$PORT
