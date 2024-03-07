<?php

namespace Kuri\Doctrine\utils;

trait ControllerTrait
{
    private function go(string $path): void {
        header("location:$path");
        exit;
    }

    private function paginaNaoEncontrada(): void {
        http_response_code(404);
        exit;
    }
}