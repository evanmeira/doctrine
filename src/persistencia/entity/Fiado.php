<?php

namespace Kuri\Doctrine\persistencia\entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use JsonSerializable;

#[Entity]
#[Table('fiado')]
class Fiado implements JsonSerializable
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column(name:'nome_cliente')]
    private string $nomeCliente;

    #[Column(type:Types::DECIMAL, precision:10, scale:2)]
    private float $valor;

    public function setNomeCliente(string $nome)
    {
        $this->nomeCliente = $nome;
    }

    public function setValor(float $valor)
    {
        $this->valor = $valor;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNomeCliente()
    {
        return $this->nomeCliente;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getValorFormatado(): string 
    {
        return 'R$ '.number_format($this->valor, 2, ',', '.');
    }

    public function jsonSerialize(): mixed
    {
        $json = [];
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }
        
        return $json;
    }
}