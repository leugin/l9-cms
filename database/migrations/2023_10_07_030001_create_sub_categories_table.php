<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignIdFor(Category::class, 'category_id')
                ->nullable(false)
                ->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignIdFor(Category::class, 'sub_category_id')
                ->nullable(false)
                ->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignIdFor(Category::class, 'child_category_id')
                ->nullable(false)
                ->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
