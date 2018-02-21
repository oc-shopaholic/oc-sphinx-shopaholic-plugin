<?php namespace Lovata\SphinxShopaholic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class UpdateTableTag
 * @package Lovata\SphinxShopaholic\Updates
 */
class UpdateTableTag extends Migration
{
    /**
     * Apply migration
     */
    public function up()
    {
        if (!Schema::hasTable('lovata_tagsshopaholic_tags') || Schema::hasColumn('lovata_tagsshopaholic_tags', 'search_synonym')) {
            return;
        }

        Schema::table('lovata_tagsshopaholic_tags', function (Blueprint $obTable) {
            $obTable->text('search_synonym')->nullable();
            $obTable->text('search_content')->nullable();
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        if (!Schema::hasTable('lovata_tagsshopaholic_tags') || !Schema::hasColumn('lovata_tagsshopaholic_tags', 'search_synonym')) {
            return;
        }

        Schema::table('lovata_tagsshopaholic_tags', function (Blueprint $obTable) {
            $obTable->dropColumn(['search_synonym', 'search_content']);
        });
    }
}
