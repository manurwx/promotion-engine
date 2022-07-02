#!/usr/bin/env sh

composer install -n
bin/console doctrine:database:drop --force -n
bin/console doctrine:database:create -n
bin/console doctrine:migrations:migrate -n
bin/console doctrine:fixtures:load -n

exec "$@"