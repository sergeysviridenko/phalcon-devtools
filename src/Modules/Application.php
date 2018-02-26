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

namespace Phalcon\Devtools\Modules;

use Phalcon\Di;
use Phalcon\Loader;
use Phalcon\Devtools\Modules\Core\String\StringColorize;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Di\FactoryDefault\Cli as CliDI;

/**
 * Phalcon\Devtools\Modules\Application
 *
 * @package Phalcon\Devtools\Modules
 */
class Application
{
    /**@var Cli*/
    private $di;

    /**@var Console*/
    private $console;

    public function __construct()
    {
        $this->di = new CliDI();
        Di::setDefault($this->di);

        $this->console = new ConsoleApp();
        $this->console->setDI($this->di);
    }

    public function run(array $argv)
    {
        try {
            $this->console->handle($this->handleConsoleCommand($argv));
        } catch (\Exception $e) {
            fwrite(STDERR, StringColorize::error('Unknown command "' . $this->getConsoleCommand($argv) . '"'));
        }
    }


    protected function getApplicationConfig()
    {
        //@todo write it
    }

    /**
     * @return array
     */
    protected function handleConsoleCommand(array $argv)
    {
        $arguments = [];

        foreach ($argv as $k => $arg) {
            if ($k === 1) {
                $arguments['task'] = $arg;
            } elseif ($k === 2) {
                $arguments['action'] = $arg;
            } elseif ($k >= 3) {
                $arguments['params'][] = $arg;
            }
        }

        return $arguments;
    }

    /**
     * @return string
     * @todo move this to class that handle string
     */
    protected function getConsoleCommand(array $argv)
    {
        unset($argv[0]);

        return implode(' ', $argv);
    }
}
