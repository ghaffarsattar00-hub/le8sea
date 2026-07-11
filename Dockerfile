# PHP ka official version use kar rahe hain
FROM php:8.4-cli

# Zaroori softwares (Node, NPM, Zip, SQLite) install kar rahe hain
RUN apt-get update && apt-get install -y git unzip sqlite3 libsqlite3-dev nodejs npm

# Composer ko root access allow karne ke liye variable
ENV COMPOSER_ALLOW_SUPERUSER=1

# Composer (Laravel ka package manager) setup kar rahe hain
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Laravel packages install kar rahe hain (bina scripts ke taake build na phate)
RUN composer install --optimize-autoloader --no-scripts

# Frontend (Tailwind/Vite) ke packages install aur compile kar rahe hain
RUN npm install && npm run build

# Website ko live karne aur aakhri steps chalane ki command
CMD php artisan package:discover && php artisan serve --host=0.0.0.0 --port=$PORT
