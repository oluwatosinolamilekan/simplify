<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

return [
    'barryvdh/laravel-ide-helper' => [
        'providers' => [
            0 => 'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',
        ],
    ],
    'bensampo/laravel-enum' => [
        'providers' => [
            0 => 'BenSampo\\Enum\\EnumServiceProvider',
        ],
    ],
    'facade/ignition' => [
        'providers' => [
            0 => 'Facade\\Ignition\\IgnitionServiceProvider',
        ],
        'aliases' => [
            'Flare' => 'Facade\\Ignition\\Facades\\Flare',
        ],
    ],
    'fideloper/proxy' => [
        'providers' => [
            0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
        ],
    ],
    'fruitcake/laravel-cors' => [
        'providers' => [
            0 => 'Fruitcake\\Cors\\CorsServiceProvider',
        ],
    ],
    'jantinnerezo/livewire-alert' => [
        'providers' => [
            0 => 'Jantinnerezo\\LivewireAlert\\LivewireAlertServiceProvider',
        ],
        'aliases' => [
            'LivewireAlert' => 'Jantinnerezo\\LivewireAlert\\LivewireAlertFacade',
        ],
    ],
    'jenssegers/agent' => [
        'providers' => [
            0 => 'Jenssegers\\Agent\\AgentServiceProvider',
        ],
        'aliases' => [
            'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
        ],
    ],
    'krlove/eloquent-model-generator' => [
        'providers' => [
            0 => 'Krlove\\EloquentModelGenerator\\Provider\\GeneratorServiceProvider',
        ],
    ],
    'laracasts/cypress' => [
        'providers' => [
            0 => 'Laracasts\\Cypress\\CypressServiceProvider',
        ],
    ],
    'laravel/fortify' => [
        'providers' => [
            0 => 'Laravel\\Fortify\\FortifyServiceProvider',
        ],
    ],
    'laravel/jetstream' => [
        'providers' => [
            0 => 'Laravel\\Jetstream\\JetstreamServiceProvider',
        ],
    ],
    'laravel/sail' => [
        'providers' => [
            0 => 'Laravel\\Sail\\SailServiceProvider',
        ],
    ],
    'laravel/sanctum' => [
        'providers' => [
            0 => 'Laravel\\Sanctum\\SanctumServiceProvider',
        ],
    ],
    'laravel/telescope' => [
        'providers' => [
            0 => 'Laravel\\Telescope\\TelescopeServiceProvider',
        ],
    ],
    'laravel/tinker' => [
        'providers' => [
            0 => 'Laravel\\Tinker\\TinkerServiceProvider',
        ],
    ],
    'livewire/livewire' => [
        'providers' => [
            0 => 'Livewire\\LivewireServiceProvider',
        ],
        'aliases' => [
            'Livewire' => 'Livewire\\Livewire',
        ],
    ],
    'maatwebsite/excel' => [
        'providers' => [
            0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
        ],
        'aliases' => [
            'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
        ],
    ],
    'mediconesystems/livewire-datatables' => [
        'providers' => [
            0 => 'Mediconesystems\\LivewireDatatables\\LivewireDatatablesServiceProvider',
        ],
        'aliases' => [
            'LivewireDatatables' => 'Mediconesystems\\LivewireDatatables\\LivewireDatatablesFacade',
        ],
    ],
    'nesbot/carbon' => [
        'providers' => [
            0 => 'Carbon\\Laravel\\ServiceProvider',
        ],
    ],
    'nunomaduro/collision' => [
        'providers' => [
            0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
        ],
    ],
    'protoqol/prequel' => [
        'providers' => [
            0 => 'Protoqol\\Prequel\\PrequelServiceProvider',
        ],
    ],
    'richan-fongdasen/eloquent-blameable' => [
        'providers' => [
            0 => 'RichanFongdasen\\EloquentBlameable\\ServiceProvider',
        ],
    ],
    'techtailor/rpg' => [
        'providers' => [
            0 => 'TechTailor\\RPG\\RPGServiceProvider',
        ],
        'aliases' => [
            'RPG' => 'TechTailor\\RPG\\Facade',
        ],
    ],
];
