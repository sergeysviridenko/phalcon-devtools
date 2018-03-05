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

namespace Phalcon\Devtools\Modules\Core\Options;

/**
 * Phalcon\Devtools\Modules\Core\Options\OptionsHandler
 *
 * Class to handle base incomming options and params
 *
 * @package Phalcon\Devtools\Modules\Core\Options
 */
class OptionsHandler implements OptionsHandlerInterface
{
    protected $params = [];

    public function __construct(array $params)
    {
        $this->setParams($params);
    }

    /**
     * Get available param
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set incomming params
     *
     * @param array
     */
    public function setParams(array $params)
    {
        $this->setBaseParams($params);
    }

    /**
     * Set base incomming and necessary params
     */
    protected function setBaseParams(array $params)
    {
        $this->params = $params;

        $this->setDirectoryParam();
    }

    /**
     * Set directory where project is located. Absolute or relative
     */
    protected function setDirectoryParam()
    {
        if (isset($this->params['directory'])) {
            $this->params['directory'] = rtrim($this->params['directory'], '\\/');
            return;
        }

        $path = defined('BASE_PATH') ? BASE_PATH : defined('APP_PATH') ? dirname(APP_PATH) : '';
        $this->params['directory'] = rtrim($path, '\\/');
    }
}