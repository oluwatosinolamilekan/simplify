# Simplify


## Minimal system requirements

- PHP >= 7.4
- MySQL >= 8
- NodeJs >= 14

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
- `$ composer stan`: perform analysis on your code

### Important!  

- After configuring local repo, make sure you run `composer install` to install required packages and `composer install-tools` to run commands for dev tools installation
- Make sure you configure your local .env configuration values (see .env.example)
- If husky & lint-staged pre-commit hooks aren't triggering (common under Windows - see [issue](https://github.com/sapegin/mrm/issues/168)):
 
```
npm install mrm mrm-task-lint-staged --save-dev
npx mrm lint-staged
npm uninstall mrm mrm-task-lint-staged
```

### Rules of thumb

- Prefix all your commits with jira ticket ID and write description about work you did - ex. *SIM-100 Implemented some cool feature* 
- Prefix all your MRs with jira ticket ID

## Tools included

- [Prequel](https://github.com/Protoqol/Prequel/) DB management tool 
    - Set .env variable PREQUEL_ENABLED to true to enable Prequel
    - Access URL: [http://host/prequel](http://host/prequel)
- [Telescope](https://github.com/laravel/telescope) debug assistant for the Laravel framework  
    - To enable Telescope set .env variable TELESCOPE_ENABLED to true
    - Access URL: [http://host/telescope](http://host/telescope)


