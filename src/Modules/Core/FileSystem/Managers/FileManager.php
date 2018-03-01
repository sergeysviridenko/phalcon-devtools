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

use Phalcon\Devtools\Modules\Core\FileSystem\AbstractFileSystem;
use Phalcon\Devtools\Modules\Core\Exceptions\InvalidArgumentException;

/**
 * Phalcon\Devtools\Modules\Core\FileSystem\Managers\FileManager
 *
 * @property \SplFileInfo $fileSystemManager
 *
 * @package Phalcon\Devtools\Modules\Core\FileSystem\Managers
 */
class FileManager extends AbstractFileSystem
{
    public function getManager()
    {
        $this->checkManager();

        return $this->fileSystemManager;
    }

    /*
     * Read file content
     *
     * @return string
     */
    public function readFileContent()
    {
        $this->checkManager();

        $fileObject = $this->fileSystemManager->openFile('r');

        return $fileObject->fread($this->fileSystemManager->getSize());
    }

    public function getincludedContentFile()
    {
        $this->checkManager();

        return include $this->fileSystemManager->getRealPath();
    }

    /**
     * Set new object that handle file
     */
    protected function assertManager(string $path)
    {
        $manager = new \SplFileInfo($path);

        if (!$this->fileSystemManager->isFile()) {
            throw new InvalidArgumentException("Path '{$path}' should be a file");
        }

        $this->fileSystemManager = $manager;
    }
}
