<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use SignupFormTest\Framework\DatabaseConnection\DatabaseConnection;
use SignupFormTest\Framework\DatabaseConnection\PsqlDatabase;
use SignupFormTest\Framework\Configuration;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv(__DIR__, 'config.env');
$dotenv->load();

$psql = new DatabaseConnection(new PsqlDatabase());
$psql = $psql->connect(Configuration::get('db.psql'));

return ConsoleRunner::createHelperSet($psql);