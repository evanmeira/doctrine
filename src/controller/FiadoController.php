<?php

namespace Kuri\Doctrine\controller;

use Kuri\Doctrine\persistencia\entity\Fiado;
use Kuri\Doctrine\persistencia\repository\FiadoRepository;
use Kuri\Doctrine\Router;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

class FiadoController extends Controller
{
    private const ROUTES = [
        '' => 'home',
        'listar' => 'listarFiados',
        'novo' => 'novoFiado',
        'editar' => 'editarFiado',
        'inserir' => 'inserirFiado',
        'atualizar' => 'atualizarFiado',
        'excluir' => 'excluirFiado',
        'gerar-json' => 'getJson',
        'gerar-xml' => 'getXml'
    ];

    public function __construct(Router $router)
    {
        $this->routes = self::ROUTES;
        parent::__construct($router);        
    }
    
    protected function home(): ResponseInterface {
        $html = $this->gerarHTML('home.php');
        return new Response(200, [], $html);
    }

    protected function listarFiados(): ResponseInterface {
        $dados['fiadoList'] = FiadoRepository::getFiados();
        $html = $this->gerarHTML('fiado/lista.php', $dados);
        return new Response(200, [], $html);
    }

    protected function novoFiado(): ResponseInterface {
        $html = $this->gerarHTML('fiado/formulario.php');
        return new Response(200, [], $html);
    }

    protected function editarFiado(): ResponseInterface {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id) {
            return new Response(404);
        }

        $fiado = FiadoRepository::getById($id);
        if(!$fiado) {
            return new Response(404);
        }

        $dados['fiado'] = $fiado;
        $html = $this->gerarHTML('fiado/formulario.php', $dados);
        return new Response(200, [], $html);
    }

    protected function inserirFiado(): ResponseInterface {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
        $fiado = new Fiado();
        $fiado->setNomeCliente($nome);
        $fiado->setValor($valor);

        FiadoRepository::insert($fiado);

        return new Response(302, ['Location' => '/fiado/listar']);
    }

    protected function atualizarFiado(): ResponseInterface {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id) {
            return new Response(404);
        }

        $fiado = FiadoRepository::getById($id);
        if(!$fiado) {
            return new Response(404);
        }

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
        $fiado->setNomeCliente($nome);
        $fiado->setValor($valor);

        FiadoRepository::update($fiado);

        return new Response(302, ['Location' => '/fiado/listar']);
    }

    protected function excluirFiado(): ResponseInterface {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id) {
            return new Response(404);
        }

        FiadoRepository::delete($id);

        return new Response(302, ['Location' => '/fiado/listar']);
    }   
    
    protected function getJson(): ResponseInterface {
        $fiados = FiadoRepository::getFiados();        
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($fiados));
    }

    protected function getXml(): ResponseInterface {
        $fiados = FiadoRepository::getFiados();
        $fiadosXml = new SimpleXMLElement('<fiados/>');
        //$fiadosXml = new SimpleXMLElement('<fiados></fiados>');

        foreach($fiados as $f) {
            $fXml = $fiadosXml->addChild('fiado');
            $fXml->addChild('id', $f->getId());
            $fXml->addChild('nomeCliente', $f->getNomeCliente());
            $fXml->addChild('valor', $f->getValor());
        }

        return new Response(200, ['Content-Type' => 'application/xml'], $fiadosXml->asXML());
    }
}