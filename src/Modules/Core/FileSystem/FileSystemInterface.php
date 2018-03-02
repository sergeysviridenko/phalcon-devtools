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

namespace Phalcon\Devtools\Modules\Core\FileSystem;

/**
 * Phalcon\Devtools\Modules\Core\FileSystem\FileSystemInterface
 *
 * Base interface to work with files and folders
 *
 * @package Phalcon\Devtools\Modules\Core\FileSystem
 */
interface FileSystemInterface
{
    /**
     * Create new object from path
     */
    public function setManager(string $path);

    /**
     * Get object that has been defined as manager
     */
    public function getManager();
}
