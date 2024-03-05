<?php

namespace Kuri\Doctrine;

use Kuri\Doctrine\controller\FiadoController;
use Kuri\Doctrine\controller\LoginController;
use Kuri\Doctrine\controller\UsuarioController;
use Kuri\Doctrine\utils\ControllerTrait;

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
        if(key_exists(@$pathArray[1], self::CONTROLLERS)) {
            if(!isset($_SESSION['user']) && @$pathArray[1] != 'login') {
                $this->go('/login');

            } else if(isset($_SESSION['user']) && @$pathArray[1] === 'login'
                && @$pathArray[2] != 'logoff') {
                $this->go('/');
            }

            new (self::CONTROLLERS[@$pathArray[1]])(@$pathArray[2]);

        } else {
            $this->paginaNaoEncontrada();
        }                
    }
}