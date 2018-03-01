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

namespace Phalcon\Devtools\Modules\Core\Services\ServicesList\Registry;

use Phalcon\Registry;
use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Phalcon\Devtools\Modules\Core\Services\ServiceList\Registry\ServiceProvider
 *
 * @package Phalcon\Devtools\Modules\Core\Services\ServicesList\Registry
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Pathes should be added to registry
     *
     * @var array $path
     */
    protected $path = [
        'template_path' => PTOOLSPATH . DS . 'resources' . DS . 'templates',
        'system_config_path' => PTOOLSPATH . DS . 'config',
    ];

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register(DiInterface $di)
    {
        $path = $this->path;

        $di->setShared(
            'registry',
            function () use ($path) {
                $registry = new Registry();

                foreach ($path as $offset => $value) {
                    $registry->offsetSet($offset, $value);
                }

                return $registry;
            }
        );
    }
}
