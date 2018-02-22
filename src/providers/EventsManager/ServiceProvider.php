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
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com              |
  +------------------------------------------------------------------------+
*/

namespace Devtools\Provider\EventsManager;

use Phalcon\DiInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Devtools\Provider\EventsManager\ServiceProvider
 *
 * @package Devtools\Provider\EventsManager
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
            'eventsManager',
            function () {
                $em = new EventsManager;
                $em->enablePriorities(true);

                return $em;
            }
        );
    }
}
