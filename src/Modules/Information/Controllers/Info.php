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

use Phalcon\Cli\Task;
use Phalcon\Version as PhVersion;
use Phalcon\Devtools\Modules\Core\Devtools\Version;

class Info extends Task
{
    public function basic()
    {
        echo $this->getInformation();
    }

    private function getInformation()
    {
        $consoleOutput = $this->getDI()->getShared('consoleOutput');

        printf("%s\n", $consoleOutput->head('Environment:'));
        foreach ($this->getEnvironment() as $type => $value) {
            printf("  %s: %s\n", $type, $value);
        }
        printf("%s\n", $consoleOutput->head('Versions:'));
        foreach ($this->getVersions() as $type => $value) {
            printf("  %s: %s\n", $type, $value);
        }
    }

    private function getEnvironment()
    {
        return [
            'OS' => php_uname(),
            'PHP Version' => PHP_VERSION,
            'PHP SAPI' => php_sapi_name(),
            'PHP Bin' => PHP_BINARY,
            'PHP Extension Dir' => PHP_EXTENSION_DIR,
            'PHP Bin Dir' => PHP_BINDIR,
            'Loaded PHP config' => php_ini_loaded_file(),
        ];
    }

    private function getVersions()
    {
        return [
            'Phalcon DevTools Version' => Version::get(),
            'Phalcon Version' => PhVersion::get(),
            'AdminLTE Version' => ADMIN_LTE_VERSION,
        ];
    }
}
