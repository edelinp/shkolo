#!/bin/sh -e

composer install

if [ ! -f ".env" ]; then
    if [ ! -z "$APP_ENV" ] && [ -f ".env.$APP_ENV" ]; then
        cp .env.$APP_ENV .env
    else
        cp .env.example .env
        echo "Using example env file"
    fi
else
    echo "Using existing .env"
fi

npm install
npm run build
php artisan key:generate
php artisan migrate:fresh --seed

# Set max concurrency to match pm.max_children. Default to 4
if [ -z $NUM_THREADS ]; then
    sed -i'' "s/%MAX_CHILDREN/4/g" /usr/local/etc/php-fpm.d/www.conf
else
    sed -i'' "s/%MAX_CHILDREN/${NUM_THREADS}/g" /usr/local/etc/php-fpm.d/www.conf
fi

if [ "${1#-}" != "$1" ]; then
	set -- php "$@"
fi

exec "$@"
