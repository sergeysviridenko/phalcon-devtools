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

namespace Phalcon\Devtools\Modules\Core\Services\Services\ConsoleOutput;

use Phalcon\Devtools\Modules\Core\Strings\ConsoleOutput;
use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Phalcon\Devtools\Modules\Core\Services\Service\ConsoleOutput\ServiceProvider
 *
 * @package Phalcon\Devtools\Modules\Core\Services\Services\ConsoleOutput
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
        $di->setShared(
            'consoleOutput',
            function () {
                return new ConsoleOutput();
            }
        );
    }
}
