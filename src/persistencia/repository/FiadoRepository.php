<?php

namespace Kuri\Doctrine\persistencia\repository;

use Kuri\Doctrine\persistencia\entity\Fiado;
use Kuri\Doctrine\persistencia\helper\EntityManagerFactory;

class FiadoRepository
{
    public static function insert(Fiado $fiado): void
    {
        $em = EntityManagerFactory::getEntityManager();
        $em->persist($fiado);
        $em->flush();
    }

    public static function getFiados(): array
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Fiado::class)
            ->findAll();
    }

    public static function getById(int $id): Fiado | null
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Fiado::class)
            ->find($id);
    }

    public static function update(Fiado $fiado): void
    {
        $em = EntityManagerFactory::getEntityManager();
        $f = $em->getRepository(Fiado::class)->find($fiado->getId());
        
        $f->setNomeCliente($fiado->getNomeCliente());
        $f->setValor($fiado->getValor());

        $em->flush();
    }

    public static function delete(int $id): void
    {
        $em = EntityManagerFactory::getEntityManager();
        $fiado = $em->getRepository(Fiado::class)->find($id);
        if(is_null($fiado))
        {
            die('Registro não encontrado');
        }
        $em->remove($fiado);
        $em->flush();
    }
}