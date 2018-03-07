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

namespace Phalcon\Devtools\Modules;

use Phalcon\Di;
use Phalcon\Loader;
use Phalcon\DispatcherInterface;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Devtools\Modules\Core\Devtools\Version;
use Phalcon\Devtools\Modules\Core\String\StringColorize;
use Phalcon\Devtools\Modules\Core\Services\ServiceManager;
use Phalcon\Devtools\Modules\Core\FileSystem\Managers\DirectoryManager;

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

    /**@var DirectoryManager */
    private $directoryManager;

    public function __construct()
    {
        $this->build();
        $this->registerServices();

        $this->console->registerModules(
            [
                'publish' => [
                    'className' => 'Phalcon\Devtools\Modules\Publish\Module',
                    'path'      => PTOOLSPATH . '/src/Modules/Publish/Module.php',
                ],
            ]
        );

        $router = $this->di->getShared('router');
        $router->add(
            '/publish/:action/:params',
            [
                "module" => 'publish',
                "task"   => 'publish',
				"action" => 1,
				"params" => 2,
			]
        );

        $this->shouldDelete();
    }

    protected function shouldDelete()//@todo SHOULD BE DELETED
    {

//        fwrite(fopen('/home/pdffiller-lenovo510/phalcon-devtools/devtools.log', 'a'), PHP_EOL .$tt. PHP_EOL);
//        var_dump($this->di);die;
    }

    public function run(array $argv)
    {
        try {
            $this->printVendorInfo();

            $this->console->handle($this->handleConsoleCommand($argv));
        } catch (\Exception $e) {
            fwrite(STDERR, StringColorize::error('Unknown command "' . $this->getConsoleCommand($argv) . '"'));
        }
    }

    protected function build()
    {
        $this->di = new CliDI();
        $this->console = new ConsoleApp();
        $this->directoryManager = new DirectoryManager();

        $this->console->setDI($this->di);
        Di::setDefault($this->di);
    }


    protected function getApplicationConfig()
    {
        //@todo write it
    }

    /**
     * @return array
     * //@todo add command parser
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

    /**
     * Register available revices
     */
    protected function registerServices()
    {
        $serviceManager = new ServiceManager($this->di);

        $this->directoryManager->setManager(SERVICES_PATH);
        foreach ($this->directoryManager->getFoldersList() as $service) {
            if (!$serviceManager->register($service)) {
                throw new \RuntimeException("Service {$service} can't be registered");
            }
        }
    }

    protected function printVendorInfo()
    {
        $vendor = sprintf('Phalcon DevTools (%s)', Version::get());
        print PHP_EOL . StringColorize::colorize($vendor, StringColorize::FG_GREEN, StringColorize::AT_BOLD) . PHP_EOL . PHP_EOL;
    }
}
