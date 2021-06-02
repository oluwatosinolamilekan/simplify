# Simplify


## Minimal system requirements

- PHP >= 7.4
- MySQL >= 8
- NodeJs >= 14

## Coding standard

- PSR-12 [https://www.php-fig.org/psr/psr-12/](https://www.php-fig.org/psr/psr-12/)
- Laravel Coding Style Ruleset

## Composer Commands

Global installation of composer is recommended [https://getcomposer.org/doc/00-intro.md#globally](https://getcomposer.org/doc/00-intro.md#globally)

- `$ composer start`: starts the application
- `$ composer fix`: runs php-cs-fixer tool configured to Laravel Coding Style Ruleset
- `$ composer stan`: perform analysis on your code
- `$ composer test`: runs test
- `$ composer migrate`: runs all of the available migrations
- `$ composer migrate:rollback`: rolls back *the last* batch of migrations
- `$ composer make:migration <name>`: creates new migration
- `$ composer make:livewire <name>`: creates new livewire component and view

### Important!  

- After configuring local repo, make sure you run 
    - `composer install` to install required packages 
    - `composer install-tools` to run commands for dev tools installation
    - `composer install-jetstream` to install jetstream starter kit
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
    
## Useful commands

- `php artisan ide-helper:models` - Generate phpdocs for model classes
- `php artisan enum:annotate` - Annotate enums
- `php artisan make:command <name>` - Create console command
- `php artisan create:admin` - Create admin user

## Livewire configuration

Livewire configuration file can be found in `config/livewire.php` file.
Use `composer make:livewire` command to generate components and views.
See [https://laravel-livewire.com/docs/2.x/artisan-commands](https://laravel-livewire.com/docs/2.x/artisan-commands) for more information on command line arguments.
- Component namespace (by config) is: `App\\View\\Components`
- View path (by config) is: `resources\views`




