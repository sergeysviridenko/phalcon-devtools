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
use Phalcon\Devtools\Modules\Core\Exceptions\InvalidArgumentException;

/**
 * Phalcon\Devtools\Modules\Core\Commands\Manager\CommandsManagerInterface
 *
 * @package Phalcon\Devtools\Modules\Core\Commands\Manager
 */
interface CommandsManagerInterface
{
    public function __construct(array $commands);
    
    /**
     *@return array
     */
    public function getCommands();

    /**
     *@return bool
     */
    public function hasCommand(string $commandName);

    /**
     *@param string
     *
     *@return CommandInterface
     *
     *@throws InvalidArgumentException
     */
    public function getCommand(string $commandName);

    /**
     * @param CommandInterface
     */
    public function setCommand(CommandInterface $command);
}
