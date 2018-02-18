<?php
/**
 * User: david
 * Date: 01/01/18
 * Time: 23.08
 */

namespace Lejubila\PiDomoticHome\ExampleModule\Widgets;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Lejubila\PiDomoticHome\Widgets\AbstractWidget;
use Lejubila\PiDomoticHome\ExampleModule\Module;

class ButtonStartStop extends AbstractWidget
{

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'state' => null,
        'name' => 'Button_test',
        'actionOnUrl' => 'example.widget.ButtonoStartStop.on',
        'actionOffUrl' => 'example.widget.ButtonoStartStop.off',
        'actionButtonOnClass' => 'fa-play',
        'actionButtonOffClass' => 'fa-stop',
        'actionButtonOnText' => 'Start',
        'actionButtonOffText' => 'Stop',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $module = App::make(Module::class);

        $idWidget = $this->getMD5Id().'-'.$this->config['name'];
        $idWidgetType = $this->getMD5Id();

        $button = new \stdClass();
        $button->name = $this->config['name'];
        $this->config['state'] = Session::get('wid-'.$idWidget, 0);
        $this->config['actionOnUrl'] = route($this->config['actionOnUrl']);
        $this->config['actionOffUrl'] = route($this->config['actionOffUrl']);
        if( !$this->config['state']){
            $button->actionUrl = $this->config['actionOnUrl'];
            $button->actionButtonClass = $this->config['actionButtonOnClass'];
            $button->actionButtonText = $this->config['actionButtonOnText'];
        } else {
            $button->actionUrl = $this->config['actionOffUrl'];
            $button->actionButtonClass = $this->config['actionButtonOffClass'];
            $button->actionButtonText = $this->config['actionButtonOffText'];
        }

        return view($module->getViewNamespace().'::widgets.button_start_stop', [
            'config' => $this->config,
            'nameWidget' => self::getName(),
            'descriptionWidget' => self::getDescription(),
            'idWidgetType' => $idWidgetType,
            'idWidget' => $idWidget,
            'button' => $button,
        ]);
    }

    /**
     * Return name of widget
     * @return string
     */
    public static function getName(): string
    {
        return trans('pidomotichome.modules.example::widgets.button.name');
    }

    /**
     * Return description of widget
     * @return string
     */
    public static function getDescription(): string
    {
        return trans('pidomotichome.modules.example::widgets.button.description');
    }
}