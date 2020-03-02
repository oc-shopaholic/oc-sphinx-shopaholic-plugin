<?php namespace Lovata\SphinxShopaholic\Classes\Event;

use System\Classes\PluginManager;
use Lovata\SphinxShopaholic\Classes\Helper\SearchHelper;

/**
 * Class TagModelHandler
 * @package Lovata\SphinxShopaholic\Classes\Event
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class TagModelHandler
{
    /**
     * Add listeners
     */
    public function subscribe()
    {
        if (!PluginManager::instance()->hasPlugin('Lovata.TagsShopaholic')) {
            return;
        }

        \Lovata\TagsShopaholic\Models\Tag::extend(function ($obModel) {
            /** @var \Lovata\TagsShopaholic\Models\Tag $obModel */
            $obModel->fillable[] = 'search_synonym';
            $obModel->fillable[] = 'search_content';
        });

        \Lovata\TagsShopaholic\Classes\Collection\TagCollection::extend(function ($obCollection) {
            /** @var \Lovata\TagsShopaholic\Classes\Collection\TagCollection $obCollection */
            $obCollection->addDynamicMethod('search', function ($sSearch) use ($obCollection) {

                /** @var SearchHelper $obSearchHelper */
                $obSearchHelper = app(SearchHelper::class, ['tag']);
                $arElementIDList = $obSearchHelper->result($sSearch);

                return $obCollection->applySorting($arElementIDList);
            });
        });
    }
}
