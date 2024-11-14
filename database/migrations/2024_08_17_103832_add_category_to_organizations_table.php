<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_category_to_organizations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('category')->nullable();
        });
    }

    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
}
