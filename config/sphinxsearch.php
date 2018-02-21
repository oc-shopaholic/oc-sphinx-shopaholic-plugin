<?php

return [
    'host'     => '127.0.0.1',
    'port'     => 9312,

    /*
     |--------------------------------------------------------------------------
     | List of Sphinx indexes
     |--------------------------------------------------------------------------
     | Configure indexes with keys: product, brand, category, tag
     */
    'indexes'  => [
        'product'  => ['table' => 'lovata_shopaholic_products', 'column' => 'id'],
        'brand'    => ['table' => 'lovata_shopaholic_brands', 'column' => 'id'],
        'category' => ['table' => 'lovata_shopaholic_categories', 'column' => 'id'],
        'tag'      => ['table' => 'lovata_tagsshopaholic_tags', 'column' => 'id'],
    ],

    /*
     |--------------------------------------------------------------------------
     | Set settings for product index
     |--------------------------------------------------------------------------
     */
    'product'  => [
        'search_index' => 'oc_product',
        'weight'       => [
            'name'           => 100,
            'preview_text'   => 5,
            'description'    => 1,
            'search_synonum' => 50,
            'search_content' => 1,
        ],
        'match_mode'   => \Sphinx\SphinxClient::SPH_MATCH_EXTENDED2,
        'sort_mode'    => \Sphinx\SphinxClient::SPH_SORT_EXTENDED,
        'sort_by'      => '@weight DESC',
    ],

    /*
     |--------------------------------------------------------------------------
     | Set settings for brand index
     |--------------------------------------------------------------------------
     */
    'brand'    => [
        'search_index' => 'oc_brand',
        'weight'       => [
            'name'           => 100,
            'preview_text'   => 5,
            'description'    => 1,
            'search_synonum' => 50,
            'search_content' => 1,
        ],
        'match_mode'   => \Sphinx\SphinxClient::SPH_MATCH_EXTENDED2,
        'sort_mode'    => \Sphinx\SphinxClient::SPH_SORT_EXTENDED,
        'sort_by'      => '@weight DESC',
    ],

    /*
     |--------------------------------------------------------------------------
     | Set settings for category index
     |--------------------------------------------------------------------------
     */
    'category' => [
        'search_index' => 'oc_category',
        'weight'       => [
            'name'           => 100,
            'preview_text'   => 5,
            'description'    => 1,
            'search_synonum' => 50,
            'search_content' => 1,
        ],
        'match_mode'   => \Sphinx\SphinxClient::SPH_MATCH_EXTENDED2,
        'sort_mode'    => \Sphinx\SphinxClient::SPH_SORT_EXTENDED,
        'sort_by'      => '@weight DESC',
    ],
    /*
     |--------------------------------------------------------------------------
     | Set settings for tag index
     |--------------------------------------------------------------------------
     */
    'tag'      => [
        'search_index' => 'oc_tag',
        'weight'       => [
            'name'           => 100,
            'preview_text'   => 5,
            'description'    => 1,
            'search_synonum' => 50,
            'search_content' => 1,
        ],
        'match_mode'   => \Sphinx\SphinxClient::SPH_MATCH_EXTENDED2,
        'sort_mode'    => \Sphinx\SphinxClient::SPH_SORT_EXTENDED,
        'sort_by'      => '@weight DESC',
    ],
];