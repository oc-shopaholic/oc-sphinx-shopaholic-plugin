# Sphinx for Shopaholic plugin

## Description

[Sphinx for Shopaholic](http://octobercms.com/plugin/lovata-sphinxshopaholic) plugin adds fields **'search_synonym'**, **'search_content''**
to [Product](https://github.com/lovata/oc-shopaholic-plugin/wiki/ProductModel),
[Brand](https://github.com/lovata/oc-shopaholic-plugin/wiki/BrandModel),
[Category](https://github.com/lovata/oc-shopaholic-plugin/wiki/CategoryModel),
[Tag](https://github.com/lovata/oc-shopaholic-plugin/wiki/TagModel) models.

[Sphinx for Shopaholic](http://octobercms.com/plugin/lovata-sphinxshopaholic) plugin adds search($sSphinxString) method to
**[ProductCollection](https://github.com/lovata/oc-shopaholic-plugin/wiki/ProductCollection)**,
**[BrandCollection](https://github.com/lovata/oc-shopaholic-plugin/wiki/BrandCollection)**,
**[CategoryCollection](https://github.com/lovata/oc-shopaholic-plugin/wiki/CategoryCollection)**,
**[TagCollection](https://github.com/lovata/oc-shopaholic-plugin/wiki/TagCollection)** classes.

## Installation Guide

1. Install Sphinx
```bash
sudo apt-get install sphinxsearch
```
2. Configure sphinx.conf. Create indexes for products, categories, brand, tags.
For example:
  * 'oc_product' - index for default language
  * 'oc_product_ru' - index for language with code ru
```smartyconfig
source oc_product
{
    ...
    sql_query = SELECT id, name, preview_text, description, search_synonym, search_content FROM lovata_shopaholic_products order by `id` DESC
    ...
}
source oc_demo_product_ru
{
    ...
    sql_query = SELECT product.id, JSON_EXTRACT(lang.attribute_data, '$.name') as name FROM lovata_shopaholic_products as product LEFT JOIN rainlab_translate_attributes as lang ON product.id = lang.model_id WHERE lang.model_type  = 'Lovata\\Shopaholic\\Models\\Product' and lang.locale = 'ru'
    ...
}
```
3. Copy sphinxsearch.php config.
```bash
cp plugins/lovata/sphinxshopaholic/config/sphinxsearch.php config/sphinxsearch.php
```
4. Configure config/sphinxsearch.php for your project


## License

© 2018, [LOVATA Group, LLC](https://lovata.com) under [GNU GPL v3](https://opensource.org/licenses/GPL-3.0).

Developed by [Andrey Kharanenka](https://github.com/kharanenka).