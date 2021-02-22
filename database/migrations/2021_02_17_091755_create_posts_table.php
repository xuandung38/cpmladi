<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
	        $table->string('slug')->nullable();
	        $table->string('thumbnail');
	        $table->string('description')->nullable();
	        $table->longText('content');
	        $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('blog_category_id')->constrained('blog_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
