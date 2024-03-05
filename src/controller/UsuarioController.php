<?php

namespace Kuri\Doctrine\controller;

use Kuri\Doctrine\persistencia\entity\Usuario;
use Kuri\Doctrine\persistencia\repository\UsuarioRepository;
use Kuri\Doctrine\utils\ControllerTrait;

class UsuarioController
{
    use ControllerTrait;

    private const ROUTES = [
        '' => 'listar',
        'listar' => 'listar',
        'novo' => 'novo',
        'editar' => 'editar',
        'inserir' => 'inserir',
        'atualizar' => 'atualizar',
        'excluir' => 'excluir'
    ];

    public function __construct(string $path)
    {
        if(key_exists($path, self::ROUTES)) {
            $this->{self::ROUTES[$path]}();
        } else {
            $this->paginaNaoEncontrada();
        }
    }

    public function listar(): void
    {
        $usuarioList = UsuarioRepository::getUsuarios();
        require_once __DIR__.'/../view/usuario/lista.php';
    }

    public function novo(): void
    {
        require_once __DIR__.'/../view/usuario/formulario.php';
    }

    public function editar(): void
    {
        $usuario = UsuarioRepository::getUsuario(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
        if(!$usuario) {
            die("Usuário #{$_GET['id']} não encontrado.");
        }
        
        require_once __DIR__.'/../view/usuario/formulario.php';
    }

    public function inserir(): void
    {
        $usuario = new Usuario(
            null,
            filter_input(INPUT_POST, 'user', FILTER_VALIDATE_EMAIL),
            password_hash($_POST['password'], PASSWORD_ARGON2I)
        );

        UsuarioRepository::insert($usuario);

        $this->go('/usuario/listar');
    }

    public function atualizar(): void
    {
        $usuario = new Usuario(
            filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT),
            filter_input(INPUT_POST, 'user', FILTER_VALIDATE_EMAIL),
            password_hash($_POST['password'], PASSWORD_ARGON2I)
        );

        UsuarioRepository::atualizar($usuario);

        $this->go('/usuario/listar');
    }

    public function excluir(): void
    {
        UsuarioRepository::excluir(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));

        $this->go('/usuario/listar');
    }
}