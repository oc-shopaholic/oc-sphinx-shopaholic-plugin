<?php namespace Lovata\SphinxShopaholic\Classes\Helper;

use sngrl\SphinxSearch\SphinxSearch;
use October\Rain\Support\Facades\Config;
use Lovata\Toolbox\Traits\Helpers\TraitInitActiveLang;

/**
 * Class SearchHelper
 * @package Lovata\SearchShopaholic\Classes\Helper
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class SearchHelper
{
    use TraitInitActiveLang;

    /** @var string */
    protected $sIndexName;

    /** @var string */
    protected $sModelName;

    /** @var array */
    protected $arWeightSettings = [];

    /** @var string */
    protected $sSortMode;

    /** @var string */
    protected $sSortBy;

    /** @var array */
    protected $arMatchMode = [];

    /** @var string */
    protected $sSearch;

    /** @var SphinxSearch */
    protected $obSphinx;

    /** @var array */
    protected $arResultIDList;

    /**
     * SearchHelper constructor.
     * @param string $sModelName
     */
    public function __construct($sModelName)
    {
        $this->initActiveLang();

        $this->sModelName = $sModelName;
        $this->sIndexName = Config::get('sphinxsearch.'.$this->sModelName.'.search_index');
        if (!empty(self::$sActiveLang)) {
            $this->sIndexName .= '_'.self::$sActiveLang;
        }

        $this->arWeightSettings = Config::get('sphinxsearch.'.$this->sModelName.'.weight');

        $this->arMatchMode = Config::get('sphinxsearch.'.$this->sModelName.'.match_mode');
        if (empty($this->arMatchMode) || !is_array($this->arMatchMode)) {
            $this->arMatchMode = [\Sphinx\SphinxClient::SPH_MATCH_EXTENDED2];
        }

        $this->sSortMode = Config::get('sphinxsearch.'.$this->sModelName.'.sort_mode');
        if (empty($this->sSortMode)) {
            $this->sSortMode = \Sphinx\SphinxClient::SPH_SORT_EXTENDED;
        }

        $this->sSortBy = Config::get('sphinxsearch.'.$this->sModelName.'.sort_by');
        if (empty($this->sSortBy)) {
            $this->sSortBy = "@weight DESC";
        }

        $this->obSphinx = new SphinxSearch();
    }

    /**
     * Get ID's array with search result
     * @param string $sSearch
     *
     * @return null|array
     */
    public function result($sSearch)
    {
        $this->sSearch = trim($sSearch);
        if (!$this->validate()) {
            return null;
        }

        $this->run();

        return $this->arResultIDList;
    }

    /**
     * Send request to sphinx and ger element ID list
     */
    protected function run()
    {
        foreach ($this->arMatchMode as $sMatchMode) {
            //Search by string
            $this->obSphinx->search($this->sSearch, $this->sIndexName);

            //Apply weight settings
            if (!empty($this->arWeightSettings)) {
                $this->obSphinx->setFieldWeights($this->arWeightSettings);
            }

            $arSearchResult = $this->obSphinx
                ->setMatchMode($sMatchMode)
                ->setSortMode($this->sSortMode, $this->sSortBy)
                ->limit(1000000)
                ->query();

            if (!empty($arSearchResult) && !empty($arSearchResult['matches'])) {
                break;
            }
        }

        if (empty($arSearchResult) || empty($arSearchResult['matches'])) {
            return;
        }

        $this->arResultIDList = array_keys($arSearchResult['matches']);
    }

    /**
     * Validate search model, search string, search settings
     * @return bool
     */
    protected function validate()
    {
        //Check search string and search index
        if (empty($this->sSearch) || empty($this->sSearch)) {
            return false;
        }

        return true;
    }
}