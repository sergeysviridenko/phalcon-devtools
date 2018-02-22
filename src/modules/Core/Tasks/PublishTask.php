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

use Phalcon\Cli\Task;

class PublishTask extends Task
{
    public function mainAction()
    {
        echo 'это задача по умолчанию и действие по умолчанию PUBLISH' . PHP_EOL;
    }

    /**
     * @param array $params
     */
    public function runAction(array $params)
    {
        echo sprintf('hello PUBLISH %s', $params[0]);

        echo PHP_EOL;

        echo sprintf('best regards PUBLISH, %s', $params[1]);

        echo PHP_EOL;
    }
}
