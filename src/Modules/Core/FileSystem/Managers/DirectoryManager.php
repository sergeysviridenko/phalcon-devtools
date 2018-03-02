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
 * Phalcon\Devtools\Modules\Core\FileSystem\Managers\DirectoryManager
 *
 * @property \DirectoryIterator $fileSystemManager
 *
 * @package Phalcon\Devtools\Modules\Core\FileSystem\Managers
 */
class DirectoryManager extends AbstractFileSystem
{
    public function getManager()
    {
        $this->checkManager();

        return $this->fileSystemManager;
    }

    /**
     * Get all folders and files in directory
     *
     * @return array
     */
    public function getFoldersAndFilesList()
    {
        return $this->assertAvailableData();
    }

    /**
     * Get all folders in directory
     *
     * @return array
     */
    public function getFoldersList()
    {
        return $this->assertAvailableData('folder');
    }

    /**
     * Get all files in directory
     *
     * @return array
     */
    public function getFilesList()
    {
        return $this->assertAvailableData('file');
    }

    /**
     * Set new object that handle directory
     */
    protected function assertManager(string $path)
    {
        if (!is_dir($path)) {
            throw new InvalidArgumentException("Path '{$path}' should be a directory");
        }

        $this->fileSystemManager = new \DirectoryIterator($path);
    }

    /**
     * @return array
     */
    protected function assertAvailableData(string $neededData = 'all')
    {
        $this->checkManager();

        $list = [];
        $this->fileSystemManager->rewind();

        while ($this->fileSystemManager->valid()) {
            if ($this->fileSystemManager->isDot()) {
                $this->fileSystemManager->next();
                continue;
            }

            if ($this->fileSystemManager->isDir() && $neededData == 'folder') {
                $list[] = $this->fileSystemManager->getFilename();
            }

            if ($this->fileSystemManager->isFile() && $neededData == 'file') {
                $list[] = $this->fileSystemManager->getFilename();
            }

            if ($neededData == 'all') {
                $list[] = $this->fileSystemManager->getFilename();
            }

            $this->fileSystemManager->next();
        }

        return $list;
    }
}
