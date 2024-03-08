<?php

namespace Kuri\Doctrine\controller;

use Kuri\Doctrine\persistencia\entity\Usuario;
use Kuri\Doctrine\persistencia\repository\UsuarioRepository;
use Kuri\Doctrine\Router;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class UsuarioController extends Controller
{
    private const ROUTES = [
        '' => 'listar',
        'listar' => 'listar',
        'novo' => 'novo',
        'editar' => 'editar',
        'inserir' => 'inserir',
        'atualizar' => 'atualizar',
        'excluir' => 'excluir'
    ];

    public function __construct(Router $router)
    {
        $this->routes = self::ROUTES;
        parent::__construct($router);        
    }

    protected function listar(): ResponseInterface
    {
        $dados['usuarioList'] = UsuarioRepository::getUsuarios();
        $html = $this->gerarHTML('usuario/lista.php', $dados);
        return new Response(200, [], $html);
    }

    protected function novo(): ResponseInterface
    {
        $html = $this->gerarHTML('usuario/formulario.php');
        return new Response(200, [], $html);
    }

    protected function editar(): ResponseInterface
    {
        $usuario = UsuarioRepository::getUsuario(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
        if(!$usuario) {
            http_response_code(400);
            die("Usuário não encontrado.");
        }
        
        $dados['usuario'] = $usuario;
        $html = $this->gerarHTML('usuario/formulario.php', $dados);
        return new Response(200, [], $html);
    }

    protected function inserir(): ResponseInterface
    {
        $usuario = new Usuario(
            null,
            filter_input(INPUT_POST, 'user', FILTER_VALIDATE_EMAIL),
            password_hash($_POST['password'], PASSWORD_ARGON2I)
        );

        UsuarioRepository::insert($usuario);

        return new Response(302, ['Location' => '/usuario/listar']);
    }

    protected function atualizar(): ResponseInterface
    {
        $usuario = new Usuario(
            filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT),
            filter_input(INPUT_POST, 'user', FILTER_VALIDATE_EMAIL),
            password_hash($_POST['password'], PASSWORD_ARGON2I)
        );

        UsuarioRepository::atualizar($usuario);

        return new Response(302, ['Location' => '/usuario/listar']);
    }

    protected function excluir(): ResponseInterface
    {
        UsuarioRepository::excluir(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));

        return new Response(302, ['Location' => '/usuario/listar']);
    }
}