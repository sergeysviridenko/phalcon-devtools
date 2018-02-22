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

namespace Devtools\Core;

use Phalcon\Di;
use Phalcon\Loader;
use Devtools\Core\String\StringColorize;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Di\FactoryDefault\Cli as CliDI;

/**
 * Devtools\Core\Application
 *
 * @package Devtools\Core
 */
class Application
{
    private $di;

    private $console;

    private $arguments = [];

    public function __construct()
    {
        $this->di = new CliDI();
        Di::setDefault($this->di);

        $this->console = new ConsoleApp();
        $this->console->setDI($this->di);


        $loader = new Loader();
        $loader->registerDirs(
            [
                __DIR__ . '/Tasks',
            ]
        );
        $loader->register();



    }

    public function run(array $argv)
    {
        try {
            $this->console->handle($this->getConsoleCommandArray($argv));
        } catch (\Exception $e) {
            fwrite(STDERR, StringColorize::error('Unknown command "' . $this->getConsoleCommand($argv) . '"'));
        }
    }

    protected function getApplicationConfig()
    {

    }

    /**
     * @return array
     */
    protected function getConsoleCommandArray(array $argv)
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
     */
    protected function getConsoleCommand(array $argv)
    {
        unset($argv[0]);

        return implode(' ', $argv);
    }
}
