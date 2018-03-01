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

use Phalcon\Loader;
use Phalcon\Devtools\Modules\Core\Devtools\Version;

if (!extension_loaded('phalcon')) {
    throw new Exception(
        "Phalcon extension isn't installed, follow these instructions to install it: " .
        'https://docs.phalconphp.com/en/latest/installation'
    );
}

/** @const DEVTOOLS_START_TIME The start time of the Devtools. Used for profiling. */
defined('DEVTOOLS_START_TIME') || define('DEVTOOLS_START_TIME', microtime(true));

/** @const DEVTOOLS_START_MEMORY The memory usage at the start of the application. Used for profiling. */
defined('DEVTOOLS_START_MEMORY') || define('DEVTOOLS_START_MEMORY', memory_get_usage());

/** @const PTOOLSPATH The path to the Phalcon Developers Tools. */
defined('PTOOLSPATH') || define('PTOOLSPATH', rtrim(trim(getenv('PTOOLSPATH'), '\"\'') ?: dirname(dirname(__FILE__)), '\\/'));

/**
 * Check for old versions
 */
if (rtrim(strtolower(realpath(PTOOLSPATH)), '\\/') !== rtrim(strtolower(realpath(dirname(dirname(__FILE__)))), '\\/')) {
    throw new Exception(
        sprintf(
            'The environment variable PTOOLSPATH is outdated! Current value: %s. New value: %s',
            PTOOLSPATH,
            dirname(dirname(__FILE__))
        )
    );
}

/** @const DS The DIRECTORY_SEPARATOR shortcut. */
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

/** @const SERVICES_PATH The path to the Phalcon Developers Tools services. */
defined('SERVICES_PATH') || define(
    'SERVICES_PATH',
    PTOOLSPATH . DS . 'src' . DS .'Modules' . DS . 'Core' . DS . 'Services' . DS . 'ServicesList');

/** @const ENV_PRODUCTION Application production stage. */
defined('ENV_PRODUCTION') || define('ENV_PRODUCTION', 'production');

/** @const ENV_STAGING Application staging stage. */
defined('ENV_STAGING') || define('ENV_STAGING', 'staging');

/** @const ENV_DEVELOPMENT Application development stage. */
defined('ENV_DEVELOPMENT') || define('ENV_DEVELOPMENT', 'development');

/** @const ENV_TESTING Application test stage. */
defined('ENV_TESTING') || define('ENV_TESTING', 'testing');

/** @const APPLICATION_ENV Current application stage. */
defined('APPLICATION_ENV') || define('APPLICATION_ENV', getenv('APP_ENV') ?: ENV_DEVELOPMENT);

/** @const HOSTNAME The current hostname. */
defined('HOSTNAME') || define('HOSTNAME', explode('.', gethostname())[0]);

/** @const ADMIN_LTE_VERSION The AdminLTE version. */
defined('ADMIN_LTE_VERSION') || define('ADMIN_LTE_VERSION', '2.3.6');

/** @const COMPATIBLE_VERSION The compatible Phalcon version. */
defined('COMPATIBLE_VERSION') || define('COMPATIBLE_VERSION', 3020040);

/**
 * Register Devtools classes.
 */
$loader = new Loader();
$loader
    ->registerDirs([
    PTOOLSPATH . '/src/Modules/Core/Controllers',
//    PTOOLSPATH . '/src/Modules/Publish/Controllers',
])
    ->registerNamespaces([
        'Phalcon\Devtools'  => PTOOLSPATH . DS . 'src' . DS,
    ])
    ->register();

/**
 * Register the Composer autoloader (if any)
 */
if (file_exists(PTOOLSPATH . DS .'vendor' . DS . 'autoload.php')) {
//    require_once PTOOLSPATH . DS .'vendor' . DS . 'autoload.php'; //@todo it doesn't work.
}

/**
 * Register the custom loader (if any)
 */
if (file_exists('.phalcon' . DS . 'autoload.php')) {
    require_once '.phalcon' . DS . 'autoload.php'; //@todo remove it
}

if (Version::getId() < COMPATIBLE_VERSION) {
    throw new Exception(
        "Your Phalcon version isn't compatible with Developer Tools, " .
        'download the latest at: https://phalconphp.com/en/download/linux'
    );
}
