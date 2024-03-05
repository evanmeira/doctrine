<?php

namespace Kuri\Doctrine\persistencia\helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
    public static function getEntityManager(): EntityManagerInterface
    {
        $rootDir = __DIR__ . '/../../..';
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [$rootDir.'/src'],
            true //modo desenvolvimento
        );
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => $rootDir.'/data/banco.sqlite'
        ]);  
        
        return new EntityManager($connection, $config);
    }
}