<?php
/**
 * User: david
 * Date: 01/01/18
 * Time: 23.05
 */

namespace Lejubila\PiDomoticHome\Widgets;

use Arrilot\Widgets\AbstractWidget as BaseAbstractWidget;

abstract class AbstractWidget extends BaseAbstractWidget
{

    /**
     * @return mixed
     */
    abstract public function run();

    /**
     * Return name of widget
     * @return string
     */
    abstract public static function getName(): string;

    /**
     * Return description of widget
     * @return string
     */
    abstract public static function getDescription(): string;

}
