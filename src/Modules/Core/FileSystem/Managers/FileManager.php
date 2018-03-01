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

namespace Phalcon\Devtools\Modules\Core\FileSystem\Managers;

use Phalcon\Devtools\Modules\Core\Exceptions\RuntimeException;
use Phalcon\Devtools\Modules\Core\FileSystem\AbstractFileSystem;

/**
 * Phalcon\Devtools\Modules\Core\FileSystem\Managers\FileManager
 *
 * @package Phalcon\Devtools\Modules\Core\FileSystem\Managers
 */
class FileManager extends AbstractFileSystem
{
    /**@var \SplFileInfo*/
    protected $fileSystemManager = null;

    public function getManager()
    {
        if (is_null($this->fileSystemManager)) {
            throw new RuntimeException("File object hasn't been defined yet");
        }

        return $this->fileSystemManager;
    }

    /**
     * Set new object that handle file
     */
    protected function assertManager(string $path)
    {
        if (!is_file($path)) {
            throw new RuntimeException("Path '{$path}' should be a file");
        }

        $this->fileSystemManager = new \SplFileInfo($path);
    }
}
