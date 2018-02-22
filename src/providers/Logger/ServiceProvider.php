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

namespace Devtools\Provider\Logger;

use Phalcon\Logger;
use Phalcon\DiInterface;
use Phalcon\Logger\Adapter\Stream;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Logger\Formatter\Line as LineFormatter;

/**
 * Devtools\Provider\Logger\ServiceProvider
 *
 * @package Devtools\Provider\Logger
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register(DiInterface $di)
    {
        $this->di->setShared(
            'logger',
            function () use ($hostName, $basePath) {
                $logLevel = Logger::ERROR;
                if (ENV_DEVELOPMENT === APPLICATION_ENV) {
                    $logLevel = Logger::DEBUG;
                }

                $ptoolsPath = $basePath . DS . '.phalcon' . DS;
                if (is_dir($ptoolsPath) && is_writable($ptoolsPath)) {
                    $formatter = new LineFormatter("%date% {$hostName} php: [%type%] %message%", 'D j H:i:s');
                    $logger    = new FileLogger($ptoolsPath . 'devtools.log');
                } else {
                    $formatter = new LineFormatter("[devtools@{$hostName}]: [%type%] %message%", 'D j H:i:s');
                    $logger    = new Stream('php://stderr');
                }

                $logger->setFormatter($formatter);
                $logger->setLogLevel($logLevel);

                return $logger;
            }
        );
        
        
        
        
        
        
        
        $di->setShared(
            'logger',
            function () {
                $logLevel = Logger::ERROR;

                if (ENV_DEVELOPMENT === APPLICATION_ENV) {
                    $logLevel = Logger::DEBUG;
                }
            }
        );
    }
}
