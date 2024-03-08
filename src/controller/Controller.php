<?php

namespace Kuri\Doctrine\controller;

use Kuri\Doctrine\Router;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class Controller
{
    protected string $action;

    protected array $routes;

    public function __construct(Router $router)
    {
        $this->action = $router->getPath()['action'];
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if(array_key_exists($this->action, $this->routes)) {
            return $this->{$this->routes[$this->action]}();
        } else {
            return $this->paginaNaoEncontrada();
        }
    }

    protected function gerarHTML(string $viewPath, array $dados = []) {
        extract($dados);
        ob_start();
        require_once __DIR__."/../view/$viewPath";
        $html = ob_get_clean();
        return $html;
    }

    protected function paginaNaoEncontrada(): ResponseInterface {
        return new Response(404);
    }
}