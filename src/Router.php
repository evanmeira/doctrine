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
        'fiado' => FiadoController::class,
        'usuario' => UsuarioController::class,
        'login' => LoginController::class
    ];

    private static $routerAtual;

    private $path = [];

    public function __construct()
    {        
        $this->setPath();
        self::$routerAtual = $this;
        
        if(!key_exists($this->path['controller'], self::CONTROLLERS)) {
            $this->paginaNaoEncontrada();
        }
        
        if(!isset($_SESSION['user']) && $this->path['controller'] != 'login') {
            $this->go('/login');

        } else if(isset($_SESSION['user']) && $this->path['controller'] === 'login'
            && $this->path['action'] != 'logoff') {
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

        //$controller = new (self::CONTROLLERS[$this->path['controller']])($this);
        //$controller = Container::getDIContainer()->get('Kuri\Doctrine\controller\\'.ucfirst($this->path['controller']).'Controller');
        $controller = Container::getDIContainer()->get(self::CONTROLLERS[$this->path['controller']]);

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

    private function setPath(): void
    {
        $pathArray = explode('/', @$_SERVER['PATH_INFO']);
        $this->path['controller'] = $pathArray[1] ?? 'fiado';
        $this->path['action'] = $pathArray[2] ?? '';
    }

    public function getPath(): array
    {
        return $this->path;
    }

    public static function getRouterAtual(): Router
    {
        return self::$routerAtual;
    }
}