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

use Phalcon\Di;
use Phalcon\Cli\Task;
use Phalcon\Devtools\Modules\Core\Commands\Manager\CommandsManager;

class Help extends Task
{
    public function basic()
    {
        echo $this->getCommandsList();
    }

    private function getCommandsList()
    {
        $commandsManager = $this->getDI()->getShared('commandsManager');
//        $commandsManager->setCommands([]); //@todo implement it. Load data from config

        $str = '';
        foreach ($commandsManager->getCommands() as $command) {
            $str .= str_pad($command->getName(), 15) . $command->getDescription() . PHP_EOL;
        }

        return $str;
    }
}
