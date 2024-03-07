<?php

namespace Kuri\Doctrine\controller;

use Kuri\Doctrine\persistencia\repository\UsuarioRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class LoginController extends Controller
{
    private const ROUTES = [
        '' => 'login',
        'logar' => 'logar',
        'logoff' => 'logoff'
    ];

    public function __construct(string $path)
    {
        parent::__construct($path);
        $this->routes = self::ROUTES;
    }

    protected function login(): ResponseInterface
    {
        $html = $this->gerarHTML('login/formulario.php');
        return new Response(200, [], $html);
    }

    protected function logar(): ResponseInterface
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

        return new Response(302, ['Location' => '/']);
    }

    protected function logoff(): ResponseInterface
    {
        session_destroy();
        return new Response(302, ['Location' => '/']);
    }
}