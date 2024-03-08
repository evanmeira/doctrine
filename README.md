# doctrine

Projeto básico para cadastro de fiados seguindo as aulas do Edson Maia [Curso de PHP 7 OO](https://www.youtube.com/watch?v=OLX575Y5doA&list=PLnex8IkmReXz6t1rqxB-W17dbvfSL1vfg&index=35), aulas 19 a 34.

## Conceitos

- ORM (Object Relational Mapper)
  - Padrão de projeto que mapea as tabelas do banco de dados relacional em entidades
- PSR-7
  - Define interfaces para manipulação de requisições e repostas (request e reposnse) HTTP
- PSR-17
  - Define um Factory para criação de objetos que implementem a PSR-7
- PSR-15
  - Define uma interface de manipulação (handle) das requisições HTTP
- Organização e exposição do projeto
  - MVC
  - Pasta public
  - Renderiziação das páginas com ob_start e ob_get_clean
  - URLs amigáveis
- Sistema de login
  - Session
  - Password hash e verify
- Traits
- Geração de JSON e XML
- PSR-11
  - Define uma interface para criação de containers para gerenciamento de Injeção de Dependência

## Tecnologias

- Composer
- autoload
- doctrine/ORM
- sqlite
- psr/http-message
  - Interfaces PSR-7
- nyholm/psr7
  - Impletação das intefaces da PSR-7
- nyholm/psr7-server
  - Factory de objetos PSR-7
- psr/http-server-handler
  - Interface Handler PSR-15
- php-di/php-di
  - Implementação um container para Injeção de Dependênia seguindo a PSR-11

## Criar tabelas SQLite

```bash
php cli-config.php orm:schema-tool:create
```
