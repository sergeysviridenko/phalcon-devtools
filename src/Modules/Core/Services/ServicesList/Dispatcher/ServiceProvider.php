<?php

/*
 +------------------------------------------------------------------------+
 | Phosphorum                                                             |
 +------------------------------------------------------------------------+
 | Copyright (c) 2013-2016 Phalcon Team and contributors                  |
 +------------------------------------------------------------------------+
 | This source file is subject to the New BSD License that is bundled     |
 | with this package in the file LICENSE.txt.                             |
 |                                                                        |
 | If you did not receive a copy of the license and are unable to         |
 | obtain it through the world-wide-web, please send an email             |
 | to license@phalconphp.com so we can send you a copy immediately.       |
 +------------------------------------------------------------------------+
*/

namespace Phalcon\Devtools\Modules\Core\Services\ServicesList\Dispatcher;

use Phalcon\DiInterface;
use Phalcon\Cli\Dispatcher;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Phalcon\Devtools\Modules\Core\Services\ServicesList\Dispatcher\ServiceProvider
 *
 * @package Phalcon\Devtools\Modules\Core\Services\ServicesList\Dispatcher
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
        $dispatcher = $di->getShared('dispatcher');

        $dispatcher->setTaskSuffix("");
        $dispatcher->setActionSuffix("");
        $dispatcher->setDefaultTask("Help");
    }
}
