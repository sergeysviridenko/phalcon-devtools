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

namespace Phalcon\Devtools\Modules\Core\Services\Services\Registry;

use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Devtools\Modules\Core\Commands\Manager\CommandsManager;

/**
 * Phalcon\Devtools\Modules\Core\Services\Service\CommandsManager\ServiceProvider
 *
 * @package Phalcon\Devtools\Modules\Core\Services\Services\CommandsManager
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register(DiInterface $di)
    {
        $defaultConfig = include PTOOLSPATH . '/config/config.php';
        
        $di->setShared(
            'commandsManager',
            function () use ($defaultConfig) {
                return new CommandsManager($defaultConfig['commands']);
            }
        );
    }
}
