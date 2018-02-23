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
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com              |
  +------------------------------------------------------------------------+
*/

namespace Devtools\Core\CliCommands;

use Devtools\Core\FactoryCliCommands;
use Devtools\Core\Exceptions\InvalidArgumentException;

/**
 * Devtools\Core\CliCommands\CliCommandsAware
 *
 * BAse class to handle cli commands
 *
 * @package Devtools\Core\CliCommands
 *
 * @todo write unit-test and `--foo` command handle
 */
class CliCommandsAware implements FactoryCliCommands
{
    /**@var array*/
    protected $commands = [];

    /**
     * @return array
     */
    public function getCliCommands(array $commands)
    {
        return $this->handleCommands($commands);
    }

    protected function handleCommands(array $commands)
    {
        foreach ($commands as $value) {
            if (substr_count($value, '=') > 0) {
                $complexParam = $this->assertComplexParam($value);
                $this->commands[key($complexParam)] = $complexParam;

                continue;
            }

            $this->commands[$this->assertSimpleParam($value)] = true;
        }
    }

    /**
     * Handle command like `--foo=bar`
     *
     * @return array
     */
    protected function assertComplexParam(string $param)
    {
        $partsOfParam = explode('=', $param);

        if ($error = $this->validateComplexParam($partsOfParam)) {
            throw new InvalidArgumentException($error . $param);
        }

        return $partsOfParam;
    }

    /**
     * Handle command like `--foo`
     *
     * @return string
     */
    protected function assertSimpleParam(string $param)
    {
        if ($error = $this->validateSimpleParam($param)) {
            throw new InvalidArgumentException($error . $param);
        }

        return $param;
    }

    /**
     * Return error message or empty string
     *
     * @return string
     */
    protected function validateComplexParam(array $partsOfParam)
    {
        if (count($partsOfParam) != 2) {
            return "Invalid definition for the parameter ";
        }

        if (strlen($partsOfParam[0]) == "") {
            return "Invalid definition for the parameter ";
        }

        if (!in_array($partsOfParam[1], ['s', 'i', 'l'])) {
            return "Incorrect data type on parameter ";
        }

        return '';
    }

    /**
     * Return error message or empty string
     *
     * @return string
     */
    protected function validateSimpleParam(string $partsOfParam)
    {
        if (!preg_match('/([a-zA-Z0-9]+)/', $partsOfParam)) {
            return "Invalid parameter ";
        }

        return '';
    }
}
