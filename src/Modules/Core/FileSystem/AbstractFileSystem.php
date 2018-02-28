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
use Phalcon\Devtools\Modules\Core\Exceptions\RuntimeException;

/**
 * Phalcon\Devtools\Modules\Core\FileSystem\AbstractFileSystem
 *
 * @package Phalcon\Devtools\Modules\Core\FileSystem
 */
abstract class AbstractFileSystem implements FileSystemInterface
{
    /**@var \DirectoryIterator*/
    protected $directoryIterator = null;

    /**@var \SplFileInfo*/
    protected $fileObject = null;

    public function __construct($path = '')
    {
        if (empty($path)) {
            return;
        }

        if (is_dir($path)) {
            $this->directoryIterator = new \DirectoryIterator($path);
            return;
        }

        if (is_file($path)) {
            $this->fileObject = new \SplFileInfo($path);
        }
    }

    /**
     * Create new \SplFileInfo object
     */
    public function setFile(string $path)
    {
        $this->fileObject = new \SplFileInfo($path);
    }

    /**
     * Create new \DirectoryIterator object
     */
    public function setDirectoryIterator(string $path)
    {
        $this->directoryIterator = new \DirectoryIterator($path);
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
     * @return array
     */
    protected function assertAvailableData($neededData = 'all')
    {
        if (is_null($this->directoryIterator)) {
            throw new RuntimeException("Uterator hasn't been defined");
        }

        $List = [];
        $this->directoryIterator->rewind();

        while ($this->directoryIterator->valid()) {
            if ($this->directoryIterator->isDot()) {
                $this->directoryIterator->next();
                continue;
            }

            if ($this->directoryIterator->isDir() && $neededData == 'folder') {
                $List[] = $this->directoryIterator->getFilename();
            }

            if ($this->directoryIterator->isFile() && $neededData == 'file') {
                $List[] = $this->directoryIterator->getFilename();
            }

            if ($neededData == 'all') {
                $List[] = $this->directoryIterator->getFilename();
            }

            $this->directoryIterator->next();
        }

        return $List;
    }
}
