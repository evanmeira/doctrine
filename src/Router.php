<?php

namespace Kuri\Doctrine;

use Kuri\Doctrine\controller\FiadoController;
use Kuri\Doctrine\controller\LoginController;
use Kuri\Doctrine\controller\UsuarioController;
use Kuri\Doctrine\utils\ControllerTrait;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

class Router 
{
    use ControllerTrait;

    private const CONTROLLERS = [
        '' => FiadoController::class,
        'fiado' => FiadoController::class,
        'usuario' => UsuarioController::class,
        'login' => LoginController::class
    ];

    public function __construct()
    {        
        $pathArray = explode('/', @$_SERVER['PATH_INFO']);
        if(!key_exists(@$pathArray[1], self::CONTROLLERS)) {
            $this->paginaNaoEncontrada();
        }
        
        if(!isset($_SESSION['user']) && @$pathArray[1] != 'login') {
            $this->go('/login');

        } else if(isset($_SESSION['user']) && @$pathArray[1] === 'login'
            && @$pathArray[2] != 'logoff') {
            $this->go('/');
        }
        
        $psr17Factory = new Psr17Factory();
        $creator = new ServerRequestCreator(
            $psr17Factory, // ServerRequestFactory
            $psr17Factory, // UrlFactory
            $psr17Factory, // UploadedFileFactory
            $psr17Factory // StreamFactory
        );

        $request = $creator->fromGlobals();

        $controller = new (self::CONTROLLERS[@$pathArray[1]])(@$pathArray[2] ?? '');

        $response = $controller->handle($request);

        if($response->getStatusCode() >= 400) {
            $this->paginaNaoEncontrada();
        }

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }
        
        echo $response->getBody();
    }
}