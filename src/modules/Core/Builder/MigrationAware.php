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

namespace Devtools\Core\Builder;

use Devtools\Core\FactoryOptions;
use Devtools\Core\FactoryMigration;
use Devtools\Core\Options\OptionsAware as MigrationOptions;

/**
 * Devtools\Core\Builder\MigrationAware
 *
 * Migration base class
 *
 * @package Devtools\Core\Builder
 */
abstract class MigrationAware implements FactoryMigration
{
    /**@var MigrationOptions */
    protected $options;

    /** Execute migration action */
    abstract public function execute();

    /**
     * Set option container
     */
    public function setOptions(FactoryOptions $options)
    {
        $this->options = $options;
    }
}
