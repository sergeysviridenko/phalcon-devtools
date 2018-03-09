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

namespace Phalcon\Devtools\Modules\Core\Module;

use Phalcon\DiInterface;

/**
 * Phalcon\Devtools\Modules\Core\Module\AbstractModule
 *
 * Base class to work with modules
 *
 * @package Phalcon\Devtools\Modules\Core\Module
 */
abstract class AbstractModule implements ModuleInterface
{
    abstract public function registerAutoloaders(DiInterface $di = null);

    abstract public function registerServices(DiInterface $di);
}
