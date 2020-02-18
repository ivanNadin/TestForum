#!/usr/bin/env bash

set -e

# shellcheck disable=SC2124
cmd=$@

>&2 echo "Configuring..."

if [[ "dev" == "${SYMFONY_ENV}" ]] ; then
    su-exec www-data composer install --no-progress --no-interaction
else
    su-exec www-data composer --no-interaction run-script post-install-cmd
    su-exec www-data bin/console cache:warmup
fi

>&2 echo "Wait for DB availability..."
until (echo >"/dev/tcp/${POSTGRES_SERVER}/${POSTGRES_PORT}") &>/dev/null; do
  sleep 1
done

>&2 echo "Postgres is up - continue..."
su-exec www-data bin/console doctrine:database:create --if-not-exists
su-exec www-data bin/console doctrine:migrations:migrate -n

>&2 echo "Loading ORM fixtures..."
su-exec www-data bin/console doctrine:fixtures:load --group="${SYMFONY_ENV}" -n -vvv

>&2 echo "Init custom fixtures..."
su-exec www-data bin/console custom_fixtures:init -n -vvv
