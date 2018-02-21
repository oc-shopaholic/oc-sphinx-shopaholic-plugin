<?php namespace Lovata\SphinxShopaholic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class UpdateTableProduct
 * @package Lovata\SphinxShopaholic\Updates
 */
class UpdateTableProduct extends Migration
{
    /**
     * Apply migration
     */
    public function up()
    {
        if (!Schema::hasTable('lovata_shopaholic_products') || Schema::hasColumn('lovata_shopaholic_products', 'search_synonym')) {
            return;
        }

        Schema::table('lovata_shopaholic_products', function (Blueprint $obTable) {
            $obTable->text('search_synonym')->nullable();
            $obTable->text('search_content')->nullable();
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        if (!Schema::hasTable('lovata_shopaholic_products') || !Schema::hasColumn('lovata_shopaholic_products', 'search_synonym')) {
            return;
        }

        Schema::table('lovata_shopaholic_products', function (Blueprint $obTable) {
            $obTable->dropColumn(['search_synonym', 'search_content']);
        });
    }
}
