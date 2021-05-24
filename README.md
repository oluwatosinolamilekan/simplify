# Simplify


## Minimal system requirements

- PHP >= 7.4
- MySQL >= 8

## Coding standard

- PSR-12 [https://www.php-fig.org/psr/psr-12/](https://www.php-fig.org/psr/psr-12/)
- Laravel Coding Style Ruleset

## Composer Commands for 

Global installation of composer is recommended [https://getcomposer.org/doc/00-intro.md#globally](https://getcomposer.org/doc/00-intro.md#globally)

- `$ composer start`: starts the application
- `$ composer fix`: runs php-cs-fixer tool configured to Laravel Coding Style Ruleset
- `$ composer migrate`: runs all of the available migrations
- `$ composer migrate:rollback`: rolls back *the last* batch of migrations
- `$ composer migration:make <name>`: creates new migration

### Important!  

Make sure you configure your local .env configuration values (see .env.example)

## Tools included

- [Prequel](https://github.com/Protoqol/Prequel/) DB management tool - to enable Prequel set .env variable PREQUEL_ENABLED to true
- [Telescope](https://github.com/laravel/telescope) debug assistant for the Laravel framework  - to enable Telescope set .env variable TELESCOPE_ENABLED to true



