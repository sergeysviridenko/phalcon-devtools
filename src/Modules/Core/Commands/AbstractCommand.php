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

namespace Phalcon\Devtools\Modules\Core\Commands;

use Phalcon\Devtools\Modules\Core\Exceptions\CommandsException;

/**
 * Phalcon\Devtools\Modules\Core\Commands\AbstractCommand
 *
 * @package Phalcon\Devtools\Modules\Core\Commands
 */
abstract class AbstractCommand implements CommandInterface
{
    /** @var string*/
    protected $commandName = '';

    /** @var string*/
    protected $commandDescription = '';

    /**@var array*/
    protected $params = [];

    /**
     * @return string
     */
    public function getName()
    {
        if ($this->commandName != '') {
            return $this->commandName;
        }

        throw new CommandsException('Command name has to be defined in each class');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        if ($this->commandDescription != '') {
            return $this->commandDescription;
        }

        throw new CommandsException('Command description has to be defined in each class');
    }

    /**
     * @return array
     */
    public function getPossibleParams()
    {
        return $this->params;
    }

    /**
     * @param int $amountSymbolToDescription
     * @return string
     */
    public function getNameAndDescriptionAsFormatedString(int $amountSymbolToDescription = 20)
    {
        return str_pad($this->getName(), $amountSymbolToDescription) . $this->getDescription();
    }

    /**
     *@param int $amountSymbolToDescription
     * @return string
     */
    public function getParamAsFormatedString(string $paramName, int $amountSymbolToDescription = 20)
    {
        if (isset($this->params[$paramName])) {
            return str_pad(array_keys($this->params, $paramName), $amountSymbolToDescription) . $this->params[$paramName];
        }

        return '';
    }
}
