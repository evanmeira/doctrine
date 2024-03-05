<?php

namespace Kuri\Doctrine\controller;

use Kuri\Doctrine\persistencia\entity\Usuario;
use Kuri\Doctrine\persistencia\repository\UsuarioRepository;
use Kuri\Doctrine\utils\ControllerTrait;

class LoginController
{
    use ControllerTrait;

    private const ROUTES = [
        '' => 'login',
        'logar' => 'logar',
        'logoff' => 'logoff'
    ];

    public function __construct($path)
    {
        if(key_exists($path, self::ROUTES)) {
            $this->{self::ROUTES[$path]}();
        } else {
            $this->paginaNaoEncontrada();
        }
    }

    private function login(): void
    {
        require_once __DIR__.'/../view/login/formulario.php';
    }

    private function logar(): void
    {
        $user = filter_input(INPUT_POST, 'user', FILTER_VALIDATE_EMAIL);

        $usuario = UsuarioRepository::getUsuarioByUser($user);

        if($usuario) {
            if(password_verify($_POST['password'], $usuario->getPassword())) {
                $_SESSION['user'] = $user;
            } else {
                $_SESSION['mensagem'] = 'Senha Incorreta.';                
            }
        } else {
            $_SESSION['mensagem'] = 'Usuário não encontrado.';
        }

        $this->go('/');
    }

    private function logoff(): void
    {
        session_destroy();
        $this->go('/');
    }
}