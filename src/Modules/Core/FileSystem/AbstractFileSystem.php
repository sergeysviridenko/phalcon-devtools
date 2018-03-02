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

use Phalcon\Devtools\Modules\Core\FileSystem\FileSystemInterface;
use Phalcon\Devtools\Modules\Core\Exceptions\RuntimeException;

/**
 * Phalcon\Devtools\Modules\Core\FileSystem\AbstractFileSystem
 *
 * @package Phalcon\Devtools\Modules\Core\FileSystem
 */
abstract class AbstractFileSystem implements FileSystemInterface
{
    protected $fileSystemManager = null;

    public function __construct(string $path = '')
    {
        if (!empty($path)) {
            $this->assertManager($path);
        }
    }

    /**
     * Create new object from path
     */
    public function setManager(string $path)
    {
        $this->assertManager($path);
    }

    /**
     * Get object that has been defined as manager
     */
    abstract public function getManager();

    /**
     * Set new object that handle directory, file or other
     */
    abstract protected function assertManager(string $path);

    /**
     * Check filesystem manager
     */
    protected function checkManager()
    {
        if (is_null($this->fileSystemManager)) {
            throw new RuntimeException("Incorrect filesystem manager");
        }

        return true;
    }
}
