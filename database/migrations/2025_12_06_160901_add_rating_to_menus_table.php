<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            // rating 0–5 dengan 1 angka di belakang koma, default 0
            $table->decimal('rating', 2, 1)->default(0)->after('image');
            // jumlah ulasan (opsional)
            $table->unsignedInteger('reviews_count')->default(0)->after('rating');
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['rating', 'reviews_count']);
        });
    }
};
