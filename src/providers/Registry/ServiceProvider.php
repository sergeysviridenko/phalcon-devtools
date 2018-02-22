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

namespace Devtools\Provider\Registry;

use Phalcon\Registry;
use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Devtools\Provider\Registry\ServiceProvider
 *
 * @package Devtools\Provider\Registry
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Pathes should be added to registry
     *
     * @var array $path
     */
    protected $path = [

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
