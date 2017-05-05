<?php

namespace SignupFormTest\Framework\DatabaseConnection;

use SignupFormTest\Framework\DatabaseConnection\Database;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class PsqlDatabase implements Database
{
    /**
     * Create database connection with PostgreSQL
     * @param array $params Database params configuration
     * @return Doctrine\ORM\EntityManager
     */
    public function connect($params)
    {
        $paths = array(__DIR__."/../../Models");
        $isDevMode = false;

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($params, $config);

        return $entityManager;
    }
}
