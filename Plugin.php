<?php namespace Lovata\SphinxShopaholic;

use Event;
use System\Classes\PluginBase;

use Lovata\SphinxShopaholic\Classes\Event\ExtendFieldHandler;
use Lovata\SphinxShopaholic\Classes\Event\CategoryModelHandler;
use Lovata\SphinxShopaholic\Classes\Event\ProductModelHandler;
use Lovata\SphinxShopaholic\Classes\Event\BrandModelHandler;
use Lovata\SphinxShopaholic\Classes\Event\TagModelHandler;

/**
 * Class Plugin
 * @package Lovata\SphinxShopaholic
 * @author Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class Plugin extends PluginBase
{
    /** @var array Plugin dependencies */
    public $require = ['Lovata.Shopaholic', 'Lovata.Toolbox'];

    /**
     * Plugin boot method
     */
    public function boot()
    {
        $this->addEventListener();
    }

    /**
     * Add event listeners
     */
    protected function addEventListener()
    {
        Event::subscribe(ExtendFieldHandler::class);
        Event::subscribe(CategoryModelHandler::class);
        Event::subscribe(ProductModelHandler::class);
        Event::subscribe(BrandModelHandler::class);
        Event::subscribe(TagModelHandler::class);
    }
}
