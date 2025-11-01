<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::table('food_items', function (Blueprint $table) {
        $table->string('restaurant_name')->nullable(); // يمكن أن يكون فارغًا إذا لم يكن لديك اسم مطعم
    });
}

public function down()
{
    Schema::table('food_items', function (Blueprint $table) {
        $table->dropColumn('restaurant_name');
    });
}

};
