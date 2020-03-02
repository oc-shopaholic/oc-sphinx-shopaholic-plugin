<?php namespace Lovata\SphinxShopaholic\Classes\Event;

use Lovata\Shopaholic\Models\Category;
use Lovata\Shopaholic\Classes\Collection\CategoryCollection;
use Lovata\SphinxShopaholic\Classes\Helper\SearchHelper;

/**
 * Class CategoryModelHandler
 * @package Lovata\SphinxShopaholic\Classes\Event
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class CategoryModelHandler
{
    /**
     * Add listeners
     */
    public function subscribe()
    {
        Category::extend(function ($obModel) {
            /** @var Category $obModel */
            $obModel->fillable[] = 'search_synonym';
            $obModel->fillable[] = 'search_content';
        });

        CategoryCollection::extend(function ($obCollection) {
            /** @var CategoryCollection $obCollection */
            $obCollection->addDynamicMethod('search', function ($sSearch) use ($obCollection) {

                /** @var SearchHelper $obSearchHelper */
                $obSearchHelper = app(SearchHelper::class, ['category']);
                $arElementIDList = $obSearchHelper->result($sSearch);

                return $obCollection->applySorting($arElementIDList);
            });
        });
    }
}
