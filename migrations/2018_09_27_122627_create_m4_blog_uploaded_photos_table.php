<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateM4BlogUploadedPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m4_blog_uploaded_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->text("uploaded_images")->nullable();
            $table->string("image_title")->nullable();
            $table->string("source")->default("unknown");
            $table->unsignedInteger("uploader_id")->nullable()->index();
            $table->timestamps();
        });
        Schema::table("m4_blog_posts",function(Blueprint $table) {
            $table->string("seo_title")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m4_blog_uploaded_photos');

        Schema::table("m4_blog_posts",function(Blueprint $table) {
            $table->dropColumn("seo_title");
        });
    }
}
