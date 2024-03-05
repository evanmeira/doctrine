<?php

namespace Kuri\Doctrine\utils;

trait ControllerTrait
{
    private function go(string $path): void {
        header("location:$path");
        exit;
    }

    private function paginaNaoEncontrada(): void {
        require_once __DIR__.'/../view/pagina_nao_encontrada.php';
    }
}