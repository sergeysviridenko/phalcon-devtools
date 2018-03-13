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

namespace Phalcon\Devtools\Modules\Core\Strings;

/**
 * Phalcon\Devtools\Modules\Core\Strings\ConsoleOutput
 *
 * Allows to generate messages using colors on xterm, ddterm, linux, etc.
 *
 * @package Phalcon\Devtools\Modules\Core\Strings
 */
class ConsoleOutput
{
    const FG_BLACK = 1;
    const FG_DARK_GRAY = 2;
    const FG_BLUE = 3;
    const FG_LIGHT_BLUE = 4;
    const FG_GREEN = 5;
    const FG_LIGHT_GREEN = 6;
    const FG_CYAN = 7;
    const FG_LIGHT_CYAN = 8;
    const FG_RED = 9;
    const FG_LIGHT_RED = 10;
    const FG_PURPLE = 11;
    const FG_LIGHT_PURPLE = 12;
    const FG_BROWN = 13;
    const FG_YELLOW = 14;
    const FG_LIGHT_GRAY = 15;
    const FG_WHITE = 16;

    const BG_BLACK = 1;
    const BG_RED = 2;
    const BG_GREEN = 3;
    const BG_YELLOW = 4;
    const BG_BLUE = 5;
    const BG_MAGENTA = 6;
    const BG_CYAN = 7;
    const BG_LIGHT_GRAY = 8;

    const AT_NORMAL = 1;
    const AT_BOLD = 2;
    const AT_ITALIC = 3;
    const AT_UNDERLINE = 4;
    const AT_BLINK = 5;
    const AT_OUTLINE = 6;
    const AT_REVERSE = 7;
    const AT_NONDISP = 8;
    const AT_STRIKE = 9;

    /**
     * @var array Map of supported foreground colors
     */
    protected $foregroundColor = [
        self::FG_BLACK => '0;30',
        self::FG_DARK_GRAY => '1;30',
        self::FG_RED => '0;31',
        self::FG_LIGHT_RED => '1;31',
        self::FG_GREEN => '0;32',
        self::FG_LIGHT_GREEN => '1;32',
        self::FG_BROWN => '0;33',
        self::FG_YELLOW => '1;33',
        self::FG_BLUE => '0;34',
        self::FG_LIGHT_BLUE => '1;34',
        self::FG_PURPLE => '0;35',
        self::FG_LIGHT_PURPLE => '1;35',
        self::FG_CYAN => '0;36',
        self::FG_LIGHT_CYAN => '1;36',
        self::FG_LIGHT_GRAY => '0;37',
        self::FG_WHITE => '1;37',
    ];

    /**
     * @var array Map of supported attributes
     */
    protected $supportedAttributes = [
        self::AT_NORMAL => '0',
        self::AT_BOLD => '1',
        self::AT_ITALIC => '3',
        self::AT_UNDERLINE => '4',
        self::AT_BLINK => '5',
        self::AT_OUTLINE => '6',
        self::AT_REVERSE => '7',
        self::AT_NONDISP => '8',
        self::AT_STRIKE => '9',
    ];

    /**
     * @var array Map of supported background colors
     */
    protected $backgroundColor = [
        self::BG_BLACK => '40',
        self::BG_RED => '41',
        self::BG_GREEN => '42',
        self::BG_YELLOW => '43',
        self::BG_BLUE => '44',
        self::BG_MAGENTA => '45',
        self::BG_CYAN => '46',
        self::BG_LIGHT_GRAY => '47',
    ];

    /**
     * @param string $string
     * @param array $params
     *
     * @return string
     */
    public function colorizeString(string $string,
        array $params = ['foregroundColor' => null, 'supportedAttributes' => null, 'backgroundColor' => null])
    {
        if (!$this->isSupportedShell()) {
            return $string;
        }

        $coloredString = '';

        foreach ($params as $type => $number) {
            if (!is_null($number)) {
                $coloredString .= $this->addColor($type, $number);
            }
        }

        $coloredString .= $string . "\033[0m";

        return $coloredString;
    }

    public function head(string $message)
    {
        return $this->colorizeString($message, ['foregroundColor' => self::FG_BROWN]);
    }

    /**
     * Color style for error messages.
     *
     * @param string $message
     * @return string
     */
    public function errorMessage(string $message)
    {
        $message = 'Error: ' . $message;
        $params = $this->getColorizeParams(['backgroundColor' => self::BG_RED,]);

        return $this->getColorizedMessageWithParams($message, $params);
    }

    /**
     * Color style for success messages.
     *
     * @param string $message
     * @return string
     */
    public function successMessage(string $message)
    {
        $message = 'Success: ' . $message;
        $params = $this->getColorizeParams(['backgroundColor' => self::BG_GREEN,]);

        return $this->getColorizedMessageWithParams($message, $params);
    }

    /**
     * Color style for info messages.
     *
     * @param string $message
     * @return string
     */
    public function infoMessage(string $message)
    {
        $message = 'Info: ' . $message;
        $params = $this->getColorizeParams(['backgroundColor' => self::BG_BLUE,]);

        return $this->getColorizedMessageWithParams($message, $params);
    }

    /**
     * Identify if console supports colors
     *
     * @return boolean
     */
    protected function isSupportedShell()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return false !== getenv('ANSICON') || 'ON' === getenv('ConEmuANSI') || 'xterm' === getenv('TERM');
        }

        return defined('STDOUT') && function_exists('posix_isatty') && posix_isatty(STDOUT);
    }

    /**
     * Color style for current type.
     *
     * @param string $colorType
     * @param string $colorValue
     * @return string
     */
    protected function addColor(string $colorType, string $colorValue)
    {
        if (isset($this->$colorType[$colorValue])) {
            return "\033[" . $this->$colorType[$colorValue] . "m";
        }

        return '';
    }

    protected function getColorizeParams($params = [])
    {
        $defaultParams = [
            'foregroundColor' => self::FG_WHITE,
            'supportedAttributes' => self::AT_BOLD,
        ];

        return array_merge($defaultParams, $params);
    }

    /**
     * @return string
     */
    protected function getColorizedMessageWithParams(string $message, array $params)
    {
        $space = strlen($message) + 4;

        $outputString = $this->colorizeString(str_pad(' ', $space), $params) . PHP_EOL;
        $outputString .= $this->colorizeString('  ' . $message . '  ', $params) . PHP_EOL;
        $outputString .= $this->colorizeString(str_pad(' ', $space), $params) . PHP_EOL;

        return $outputString;
    }
}
