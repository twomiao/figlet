<?php

/**
 * This is the part of Povils open-source library.
 *
 * @author Povilas Susinskas
 */

namespace Povils\Figlet;

/**
 * Class ColorManager
 *
 * @package Povils\Figlet
 */
class ColorManager
{
    /**
     * @var array
     */
    private $fontColors = [
        'black'        => '0;30',
        'dark_gray'    => '1;30',
        'blue'         => '0;34',
        'light_blue'   => '1;34',
        'green'        => '0;32',
        'light_green'  => '1;32',
        'cyan'         => '0;36',
        'light_cyan'   => '1;36',
        'red'          => '0;31',
        'light_red'    => '1;31',
        'purple'       => '0;35',
        'light_purple' => '1;35',
        'brown'        => '0;33',
        'yellow'       => '1;33',
        'light_gray'   => '0;37',
        'white'        => '1;37',
    ];

    /**
     * @var array
     */
    private $backgroundColors = [
        'black'      => '40',
        'red'        => '41',
        'green'      => '42',
        'yellow'     => '43',
        'blue'       => '44',
        'magenta'    => '45',
        'cyan'       => '46',
        'light_gray' => '47',
    ];

    /**
     * @param string      $text
     * @param string|null $fontColor
     * @param string|null $backgroundColor
     *
     * @return string
     * @throws \Exception
     */
    public function colorize($text, $fontColor, $backgroundColor)
    {
        $coloredText = "";

        $coloredText = $this->colorizeFont($fontColor, $coloredText);

        $coloredText = $this->colorizeBackground($backgroundColor, $coloredText);

        $coloredText .= $text . "\033[0m";

        return $coloredText;
    }

    /**
     * @param string $fontColor
     * @param string $coloredText
     *
     * @return string
     * @throws \Exception
     */
    private function colorizeFont($fontColor, $coloredText)
    {
        if (null !== $fontColor) {
            if (isset($this->fontColors[$fontColor])) {
                $coloredText .= "\033[" . $this->fontColors[$fontColor] . "m";

                return $coloredText;
            } else {
                throw new \Exception(
                    'Font color "' . $fontColor . '" doesn\'t exist' . PHP_EOL .
                    'Available font colors: ' . implode(',', $this->getFontColors())
                );
            }
        }

        return $coloredText;
    }

    /**
     * @param string $backgroundColor
     * @param string $coloredText
     *
     * @return string
     * @throws \Exception
     */
    private function colorizeBackground($backgroundColor, $coloredText)
    {
        if (null !== $backgroundColor) {
            if (isset($this->backgroundColors[$backgroundColor])) {
                $coloredText .= "\033[" . $this->backgroundColors[$backgroundColor] . "m";

                return $coloredText;
            } else {
                throw new \Exception(
                    'Background color "' . $backgroundColor . '" doesn\'t exist ' . PHP_EOL .
                    'Available background colors: ' . implode(',', $this->getBackgroundColors())
                );
            }
        }

        return $coloredText;
    }

    /**
     * Returns all font color names
     *
     * @return array
     */
    private function getFontColors()
    {
        return array_keys($this->fontColors);
    }

    /**
     * Returns all background color names
     *
     * @return array
     */
    private function getBackgroundColors()
    {
        return array_keys($this->backgroundColors);
    }
}