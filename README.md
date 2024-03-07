# doctrine

Projeto básico para cadastro de fiados seguindo as aulas do Edson Maia [Curso de PHP 7 OO](https://www.youtube.com/watch?v=OLX575Y5doA&list=PLnex8IkmReXz6t1rqxB-W17dbvfSL1vfg&index=35), aulas 19 a 34.

## Conceitos

- ORM (Object Relational Mapper)
  - Padrão de projeto que mapea as tabelas do banco de dados relacional em entidades
- PSR-7
  - Define interfaces para manipulação de requisições e repostas (request e reposnse) HTTP
- PSR-17
  - Define um Factory para ciração de objetos que implementem a PSR-7
- PSR-15
  - Define um intefacer de mainulação (handle) das requisições HTTP
- Organização e exposição do projeto
  - MVC
  - Pasta public
  - Renderiziação das páginas com ob_start e ob_get_clean
- Sistema de login
  - Session
  - Password hash e verify
- Traits

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

## Criar tabelas SQLite
```
php cli-config.php orm:schema-tool:create
```
