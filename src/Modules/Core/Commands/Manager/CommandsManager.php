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

namespace Phalcon\Devtools\Modules\Core\Commands\Manager;

use Phalcon\Devtools\Modules\Core\Commands\CommandInterface;

/**
 * Phalcon\Devtools\Modules\Core\Commands\CommandManager\AbstractManager
 *
 * @package Phalcon\Devtools\Modules\Core\Commands\CommandManager
 */
class AbstractCommandsManager implements ManagerInterface
{
    /**@var array*/
    private $commands = [];

    public function __construct(array $commands)
    {
        $this->initializeCommand($commands);
    }

    /**
     *@return array
     */
    public function getCommands()
    {
        return $this->commands;
    }
    
    /**
     * Initialize all commands available in devtools
     */
    protected function initializeCommand(array $commands)
    {
        foreach ($commands as $command => $class) {
            if (is_object($class) && $class instanceof CommandInterface) {
                $this->commands[$command] = new $class;
            }
        }
    }
}
