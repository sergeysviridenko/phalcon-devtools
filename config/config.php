<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

return [
    'modules' => [
        'publish'   => [
            'className' => 'Phalcon\Devtools\Modules\Installer\Module',
            'path'      => PTOOLSPATH . '/src/Modules/Installer/',
        ],
        'migration' => [
            'className' => 'Phalcon\Devtools\Modules\Migrations\Module',
            'path'      => PTOOLSPATH . '/src/Modules/Migrations/',
        ],
        'info' => [
            'className' => 'Phalcon\Devtools\Modules\Information\Module',
            'path'      => PTOOLSPATH . '/src/Modules/Information/',
        ],
    ],
    'commands' => [
        'help' => Phalcon\Devtools\Modules\Core\Commands\HelpCommand::class,
        'info' => Phalcon\Devtools\Modules\Information\Commands\InfoCommand::class,
    ]
];
