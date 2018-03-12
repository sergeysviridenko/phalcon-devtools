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
use Phalcon\Application;
use Phalcon\Devtools\Modules\Core\Exceptions\InvalidParameterException;

class Help extends Task
{
    /**@var Application*/
    private $app;

    public function basic()
    {
        $app = $this->getApp($this->getDI());
        var_dump($app);die;
//        var_dump(get_class_methods($this));die;
        echo 'Help content will be here' . PHP_EOL;
    }

    private function getApp(Di $di)
    {
        $app = $di->getShared('app');

        if (is_object($app) && $app instanceof Application) {
            return $app;
        }

        throw new InvalidParameterException('Class ' . __CLASS__ . ' tried to use invalid application object');
    }
}
