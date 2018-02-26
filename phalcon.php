#!/usr/bin/env php
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

use Phalcon\Devtools\Application;
use Phalcon\Devtools\Modules\Core\Devtools\Version;
use Phalcon\Devtools\Modules\Core\String\StringColorize;
use Phalcon\Exception as PhalconException;

try {
    require dirname(__FILE__) . '/bootstrap/autoload.php';
    $vendor = sprintf('Phalcon DevTools (%s)', Version::get());
    print PHP_EOL . StringColorize::colorize($vendor, StringColorize::FG_GREEN, StringColorize::AT_BOLD) . PHP_EOL . PHP_EOL;

    $applicarion = new Application();
    $applicarion->run($argv);

    $result = true;
} catch (\Exception $e) {
    fwrite(STDERR, StringColorize::info($e->getMessage() . " " . $e->getMessage()));

    $result = false;
} catch (PhalconException $e) {
    fwrite(STDERR, StringColorize::info($e->getMessage() . " " . $e->getMessage()));

    $result = false;
} catch (\Throwable $e) {
    fwrite(STDERR, StringColorize::info($e->getMessage() . " " . $e->getMessage()));

    $result = false;
}

$result || exit(1);
