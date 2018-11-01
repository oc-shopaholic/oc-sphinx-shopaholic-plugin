<?php namespace Lovata\SphinxShopaholic\Classes\Event;

use Lovata\Shopaholic\Models\Brand;
use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Models\Category;
use Lovata\Shopaholic\Controllers\Brands;
use Lovata\Shopaholic\Controllers\Products;
use Lovata\Shopaholic\Controllers\Categories;

/**
 * Class ExtendCategoryModel
 * @package Lovata\SphinxShopaholic\Classes\Event
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class ExtendFieldHandler
{
    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        $obEvent->listen('backend.form.extendFields', function ($obWidget) {
            $this->extendProductFields($obWidget);
            $this->extendBrandFields($obWidget);
            $this->extendCategoryFields($obWidget);
            $this->extendTagFields($obWidget);
        });
    }

    /**
     * Extend product fields
     * @param \Backend\Widgets\Form $obWidget
     */
    private function extendProductFields($obWidget)
    {
        // Only for the Products controller
        if (!$obWidget->getController() instanceof Products || $obWidget->isNested || empty($obWidget->context)) {
            return;
        }

        // Only for the Product model
        if (!$obWidget->model instanceof Product) {
            return;
        }

        $this->addSearchField($obWidget);
    }

    /**
     * Extend brand fields
     * @param \Backend\Widgets\Form $obWidget
     */
    private function extendBrandFields($obWidget)
    {
        // Only for the Brands controller
        if (!$obWidget->getController() instanceof Brands || $obWidget->isNested || empty($obWidget->context)) {
            return;
        }

        // Only for the Brand model
        if (!$obWidget->model instanceof Brand) {
            return;
        }

        $this->addSearchField($obWidget);
    }

    /**
     * Extend category fields
     * @param \Backend\Widgets\Form $obWidget
     */
    private function extendCategoryFields($obWidget)
    {
        // Only for the Categories controller
        if (!$obWidget->getController() instanceof Categories || $obWidget->isNested || empty($obWidget->context)) {
            return;
        }

        // Only for the Category model
        if (!$obWidget->model instanceof Category) {
            return;
        }

        $this->addSearchField($obWidget);
    }

    /**
     * Extend tag fields
     * @param \Backend\Widgets\Form $obWidget
     */
    private function extendTagFields($obWidget)
    {
        // Only for the Tags controller
        if (!$obWidget->getController() instanceof \Lovata\TagsShopaholic\Controllers\Tags || $obWidget->isNested || empty($obWidget->context)) {
            return;
        }

        // Only for the Tag model
        if (!$obWidget->model instanceof \Lovata\TagsShopaholic\Models\Tag) {
            return;
        }

        $this->addSearchField($obWidget);
    }

    /**
     * Add search_synonym field
     * @param \Backend\Widgets\Form $obWidget
     */
    private function addSearchField($obWidget)
    {
        $obWidget->addTabFields([
            'search_synonym' => [
                'label' => 'lovata.sphinxshopaholic::lang.field.search_synonym',
                'tab'   => 'lovata.sphinxshopaholic::lang.tab.search_content',
                'span'  => 'full',
                'type'  => 'textarea',
            ],
        ]);
    }
}