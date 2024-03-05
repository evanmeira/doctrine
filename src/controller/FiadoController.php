<?php

namespace Kuri\Doctrine\controller;

use Kuri\Doctrine\persistencia\entity\Fiado;
use Kuri\Doctrine\persistencia\repository\FiadoRepository;
use Kuri\Doctrine\utils\ControllerTrait;

class FiadoController
{

    use ControllerTrait;

    private const ROUTES = [
        '' => 'home',
        'listar' => 'listarFiados',
        'novo' => 'novoFiado',
        'editar' => 'editarFiado',
        'inserir' => 'inserirFiado',
        'atualizar' => 'atualizarFiado',
        'excluir' => 'excluirFiado',
    ];

    public function __construct(?string $path = '')
    {
        // @ utilizado para suprimir erros, aqui no caso
        // um possivel Warning: Undefined array key "PATH_INFO" 
        // @ retorna NULL no caso de erro
        //$path = @$_SERVER['PATH_INFO'];
        
        if(array_key_exists($path, self::ROUTES)) {
            $this->{self::ROUTES[$path]}();
        } else {
            $this->paginaNaoEncontrada();
        }        
    }

    private function home(): void {
        require_once __DIR__.'/../view/home.php';
    }

    private function listarFiados(): void {
        $fiadoList = FiadoRepository::getFiados();
        require_once __DIR__.'/../view/fiado/lista.php';
    }

    private function novoFiado(): void {
        require_once __DIR__.'/../view/fiado/formulario.php';
    }

    private function editarFiado(): void {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id) {
            die('ID não informado');
        }

        $fiado = FiadoRepository::getById($id);

        require_once __DIR__.'/../view/fiado/formulario.php';
    }

    private function inserirFiado(): void {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
        $fiado = new Fiado();
        $fiado->setNomeCliente($nome);
        $fiado->setValor($valor);

        FiadoRepository::insert($fiado);

        $this->go('/fiado/listar');
    }

    private function atualizarFiado(): void {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id) {
            die('ID não informado');
        }

        $fiado = FiadoRepository::getById($id);
        if(!$fiado) {
            die("Registro $id não encontrado");
        }

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
        $fiado->setNomeCliente($nome);
        $fiado->setValor($valor);

        FiadoRepository::update($fiado);

        $this->go('/fiado/listar');
    }

    private function excluirFiado(): void {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id) {
            die('ID não informado');
        }

        FiadoRepository::delete($id);

        $this->go('/fiado/listar');
    }        
}