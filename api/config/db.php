<?php

return [
    'psql' => [
        'driver'   => getenv('DB_PSQL_DRIVER'),
        'host'     => getenv('DB_PSQL_HOST'),
        'port'     => getenv('DB_PSQL_PORT'),
        'user'     => getenv('DB_PSQL_USER'),
        'password' => getenv('DB_PSQL_PASSWORD'),
        'dbname'   => getenv('DB_PSQL_DBNAME'),
    ]
];
