<?php namespace Lovata\SphinxShopaholic\Classes\Event;

use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Classes\Collection\ProductCollection;
use Lovata\SphinxShopaholic\Classes\Helper\SearchHelper;

/**
 * Class ProductModelHandler
 * @package Lovata\SphinxShopaholic\Classes\Event
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class ProductModelHandler
{
    /**
     * Add listeners
     */
    public function subscribe()
    {
        Product::extend(function ($obModel) {
            /** @var Product $obModel */
            $obModel->fillable[] = 'search_synonym';
            $obModel->fillable[] = 'search_content';
        });
        
        ProductCollection::extend(function ($obCollection) {
            /** @var ProductCollection $obCollection */
            $obCollection->addDynamicMethod('search', function ($sSearch) use ($obCollection) {

                /** @var SearchHelper $obSearchHelper */
                $obSearchHelper = app(SearchHelper::class, ['product']);
                $arElementIDList = $obSearchHelper->result($sSearch);

                return $obCollection->applySorting($arElementIDList);
            });
        });
    }
}
