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

namespace Devtools\Core\Exceptions;

class ConsoleCommandsExceptions extends \Exception
{
//    public function __construct($argv)
//    {
////        unset($argv[0]);
//
//        parent::__construct('Unknown command "' . $argv . '"');
////        parent::__construct('Unknown command "' . implode(' ', $argv) . '"');
//    }

//    public function __construct($message, $code, Exception $previous)
//    {
//        parent::__construct($message, $code, $previous);
//    }

public function __construct($message, $code, \Exception $previous)
{
    parent::__construct($message, $code, $previous);
}
}
