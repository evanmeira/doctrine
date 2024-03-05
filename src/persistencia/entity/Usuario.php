<?php

namespace Kuri\Doctrine\persistencia\entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('usuario')]
class Usuario
{
    #[Id]
    #[Column, GeneratedValue]
    private ?int $id;

    #[Column]
    private string $user;

    #[Column]
    private string $password;

    public function __construct(?int $id, string $user, string $password)    
    {
        $this->id = $id;
        $this->user = $user;
        $this->password = $password;
    }   
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    public function setPassword(string $pass): void
    {
        $this->password = $pass;
    }

}