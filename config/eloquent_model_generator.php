<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\Models\Model;

return [
    'model_defaults' => [
        'namespace'       => 'App\\Models',
        'base_class_name' => Model::class,
        'output_path'     => 'Models',
        'backup'          => true,
    ],
];
