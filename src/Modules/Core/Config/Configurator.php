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

namespace Phalcon\Devtools\Modules\Core\Config;

use Phalcon\Di;
use Phalcon\Registry;
use Phalcon\Devtools\Modules\Core\FileSystem\Managers\FileManager;

/**
 * Phalcon\Devtools\Modules\Core\Config\Configurator
 *
 * Class collect configuration
 *
 * @package Phalcon\Devtools\Modules\Core\Config
 */
class Configurator
{
    /**@var Di */
    private $di;

    /**@var Registry */
    private $registry;

    /**@var FileManager */
    private $fileManager;

    public function __construct()
    {
        $this->di = Di::getDefault();
        $this->registry = $this->di->getShared('registry');
        $this->fileManager = new FileManager();
    }

    /**
     * Get common config
     *
     * @return array
     */
    public function getConfig()
    {

    }

    /**
     * Get config that has been defined in user project
     */
    protected function getCustomConfig()
    {

    }

    /**
     * Get system config
     */
    protected function getDevtoolsConfig()
    {
        $this->fileManager->setManager($this->registry->offsetGet('system_config_path'));

        return $this->fileManager->getincludedContentFile();
    }
}
