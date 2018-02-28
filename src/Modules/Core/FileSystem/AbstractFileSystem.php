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

use Phalcon\Devtools\Modules\Core\FileSystemInterface;

/**
 * Phalcon\Devtools\Modules\Core\FileSystem\AbstractFileSystem
 *
 * @package Phalcon\Devtools\Modules\Core\FileSystem
 */
abstract class AbstractFileSystem implements FileSystemInterface
{
    /**@var \DirectoryIterator*/
    protected $directoryIterator;

    /**@var \SplFileInfo*/
    protected $fileObject;

    /**
     * Get all folders in directory
     *
     * @return array
     */
    public function getFolderList(string $path)
    {
        $this->setDirectoryIterator($path);

        return $this->getAvailableFolder();
    }

    /**
     * Get all files in directory
     *
     * @return array
     */
    public function getFilesList(string $path)
    {
        $this->setDirectoryIterator($path);

        return $this->getAvailableFolder(false);
    }

    /**
     * Create new \DirectoryIterator object
     */
    protected function setDirectoryIterator(string $path)
    {
        $this->directoryIterator = new \DirectoryIterator($path);
    }

    /**
     * @return array
     */
    protected function getAvailableFolder($folder = true)
    {
        $folderList = [];
        while ($this->directoryIterator->valid()) {
            if ($this->directoryIterator->isDot()) {
                $this->directoryIterator->next();
                continue;
            }

            if ($this->directoryIterator->isDir() && $folder) {
                $folderList[] = $this->directoryIterator->getFilename();
            }

            if ($this->directoryIterator->isFile() && !$folder) {
                $folderList[] = $this->directoryIterator->getFilename();
            }

            $this->directoryIterator->next();
        }

        return $folderList;
    }

    /**
     * Create new \SplFileInfo object
     */
    protected function setFileInfo(string $path)
    {
        $this->fileObject = new \SplFileInfo($path);
    }
}
