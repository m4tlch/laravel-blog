<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortDescTextreaToM4Blog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m4_blog_posts', function (Blueprint $table) {
            $table->text("short_description")->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('m4_blog_posts', function (Blueprint $table) {
            $table->dropColumn("short_description");
        });
    }
}
