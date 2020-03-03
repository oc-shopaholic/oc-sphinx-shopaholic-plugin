<?php namespace Lovata\SphinxShopaholic\Classes\Event;

use Lovata\Shopaholic\Models\Brand;
use Lovata\Shopaholic\Classes\Collection\BrandCollection;
use Lovata\SphinxShopaholic\Classes\Helper\SearchHelper;

/**
 * Class BrandModelHandler
 * @package Lovata\SphinxShopaholic\Classes\Event
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class BrandModelHandler
{
    /**
     * Add listeners
     */
    public function subscribe()
    {
        Brand::extend(function ($obModel) {
            /** @var Brand $obModel */
            $obModel->fillable[] = 'search_synonym';
            $obModel->fillable[] = 'search_content';
        });

        BrandCollection::extend(function ($obCollection) {
            /** @var BrandCollection $obCollection */
            $obCollection->addDynamicMethod('search', function ($sSearch) use ($obCollection) {

                /** @var SearchHelper $obSearchHelper */
                $obSearchHelper = app(SearchHelper::class, ['brand']);
                $arElementIDList = $obSearchHelper->result($sSearch);

                return $obCollection->applySorting($arElementIDList);
            });
        });
    }
}
