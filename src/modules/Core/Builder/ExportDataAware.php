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

use Devtools\Core\FactoryExportData;

/**
 * Devtools\Core\Builder\ExportDataAware
 *
 * Export data to application base class
 *
 * @package Devtools\Core\Builder
 */
abstract class ExportDataAware implements FactoryExportData
{
    /*
     * Export prepared data to applications
     */
    abstract public function export();
}
