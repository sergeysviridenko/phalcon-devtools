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

namespace Phalcon\Devtools\Modules\Installer\Options;

use Phalcon\Devtools\Modules\Core\Options\OptionsHandler;

/**
 * Phalcon\Devtools\Modules\Installer\Options\InstallerOptionsHandler
 *
 * Class to specofy options and params for Installer module
 *
 * @package Phalcon\Devtools\Modules\Installer\Options
 */
class InstallerOptionsHandler extends OptionsHandler
{
    public function __construct(array $params)
    {
        $this->setParams($params);
    }

    /**
     * Set incomming params
     *
     * @param array
     */
    public function setParams(array $params)
    {
        $this->setBaseParams($params);

        $this->setDefaultValueForForceParam();
    }

    /**
     * Set default value for force option
     */
    protected function setDefaultValueForForceParam()
    {
        if (!isset($this->params['force'])) {
            $this->params['force'] = false;
        }
    }
}
