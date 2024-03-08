<?php

namespace Kuri\Doctrine;

use DI\Container as DIContainer;
use DI\ContainerBuilder;

class Container
{

    private static DIContainer $DIContainer;
    
    public static function getDIContainer(): DIContainer 
    {
        if(!isset(self::$DIContainer)) {
            self::$DIContainer = (new ContainerBuilder())
            ->addDefinitions([
                Router::class => function() { return Router::getRouterAtual(); }                
            ])
            ->build();        
        }
        return self::$DIContainer;
    }    
}