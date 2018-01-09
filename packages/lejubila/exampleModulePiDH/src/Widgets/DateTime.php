<?php
/**
 * User: david
 * Date: 01/01/18
 * Time: 23.08
 */

namespace Lejubila\PiDomoticHome\ExampleModule\Widgets;

use Illuminate\Support\Facades\App;
use Lejubila\PiDomoticHome\Widgets\AbstractWidget;
use Lejubila\PiDomoticHome\ExampleModule\Module;

class DateTime extends AbstractWidget
{

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $module = App::make(Module::class);

        return view($module->getViewNamespace().'::widgets.datetime', [
            'config' => $this->config,
            'nameWidget' => self::getName(),
            'descriptionWidget' => self::getDescription(),
        ]);
    }

    /**
     * Return name of widget
     * @return string
     */
    public static function getName(): string
    {
        return trans('pidomotichome.modules.example::widgets.datetime.name');
    }

    /**
     * Return description of widget
     * @return string
     */
    public static function getDescription(): string
    {
        return trans('pidomotichome.modules.example::widgets.datetime.description');
    }
}