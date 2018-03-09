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

namespace Phalcon\Devtools\Modules\Installer;

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Devtools\Modules\Core\Module\AbstractModule;

/**
 * Phalcon\Devtools\Modules\Installer\Module
 *
 * Class to export config data to user application
 *
 * @package Phalcon\Devtools\Modules\Installer
 */
class Module extends AbstractModule
{
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $this->registerDir();
        $this->registerRoute();
    }

    public function registerServices(DiInterface $di)
    {

    }

    protected function registerDir()
    {
        (new Loader)->registerDirs(
            [
                dirname(__FILE__) . '/Controllers',
            ]
        )
            ->register();
    }

    protected function registerRoute()
    {

    }
}
