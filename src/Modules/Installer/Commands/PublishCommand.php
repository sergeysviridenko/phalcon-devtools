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

namespace Phalcon\Devtools\Modules\Installer\Commands;

use Phalcon\Devtools\Modules\Core\Commands\AbstractCommand;

/**
 * Phalcon\Devtools\Modules\Installer\Commands\PublishCommand
 *
 * @package Phalcon\Devtools\Modules\Installer\Commands
 */
class HelpCommand extends AbstractCommand
{
    /**@var string*/
    protected $commandName = 'publish';

    /** @var string*/
    protected $commandDescription = 'Export devtools config to application';

    /**@var array*/
    protected $params = [];
}
