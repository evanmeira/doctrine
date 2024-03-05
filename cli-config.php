<?php

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Kuri\Doctrine\persistencia\helper\EntityManagerFactory;

return ConsoleRunner::run(new SingleManagerProvider(EntityManagerFactory::getEntityManager()));

// execute no terminal os comandos 
// php cli-config.php list ->lista as entidades encontradas
// php cli-config.php orm:info
// php cli-config.php orm:mapping:describe Fiado
// CRIAR TABELAS MAPEADAS DAS CLASSES
// php cli-config.php orm:schema-tool:create
