<?php

namespace Kuri\Doctrine\persistencia\repository;

use Kuri\Doctrine\persistencia\entity\Usuario;
use Kuri\Doctrine\persistencia\helper\EntityManagerFactory;

class UsuarioRepository
{

    public static function getUsuarios(): array
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Usuario::class)
            ->findAll();
    }

    public static function getUsuario(int $id): Usuario
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Usuario::class)
            ->find($id);
    }

    public static function getUsuarioByUser(string $user): Usuario | null
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Usuario::class)
            ->findOneByUser($user); //(__call magic)
            //->findOneBy(['user' => $user])

    }

    public static function insert(Usuario $usuario): void
    {
        $em = EntityManagerFactory::getEntityManager();
        $em->persist($usuario);
        $em->flush();
    }

    public static function atualizar(Usuario $nUsuario): void
    {
        $em = EntityManagerFactory::getEntityManager();
        $usuario = $em->getRepository(Usuario::class)->find($nUsuario->getId());
        $usuario->setUser($nUsuario->getUser());
        $usuario->setPassword($nUsuario->getPassword());
        $em->flush();
    }

    public static function excluir(int $id): void
    {
        $em = EntityManagerFactory::getEntityManager();
        $usuario = $em->getRepository(Usuario::class)->find($id);
        $em->remove($usuario);
        $em->flush();
    }
}