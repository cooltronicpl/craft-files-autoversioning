<?php
/**
 * Craft3 Static Files Autoversioning plugin for Craft CMS 3.x
 *
 * A Twig extension for CraftCMS (Craft3.x) that helps you cache-bust your assets
 *
 * @link      https://cooltronic.pl
 * @copyright Copyright (c) 2021 cooltronicpl
 */

namespace cooltronicpl\autoversioning;

use cooltronicpl\autoversioning\twigextensions\AutoversioningTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class Autoversioning

 * @author    CoolTRONIC.pl sp. z o.o. https://cooltronic.pl
 * @author    Pawel Potacki https://potacki.com
 * @package   Autoversioning
 * @since     1.0.0
 *
 */
class Autoversioning extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Autoversioning
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public string $schemaVersion = '2.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->registerTwigExtension(new AutoversioningTwigExtension());

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

    }

    // Protected Methods
    // =========================================================================

}
