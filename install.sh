cp config.env.example config.env
docker-compose up -d
docker-compose exec workspace bash -c 'composer install'
docker-compose exec workspace bash -c 'vendor/bin/doctrine orm:schema-tool:update --force'
docker-compose exec workspace bash -c 'vendor/bin/doctrine orm:generate-proxies'
exit 1