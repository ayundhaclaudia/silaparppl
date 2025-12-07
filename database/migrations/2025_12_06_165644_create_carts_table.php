<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // user yang menyimpan menu
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // menu yang disimpan
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');

            // jumlah (kalau nanti mau dipakai)
            $table->integer('quantity')->default(1);

            $table->timestamps();

            // 1 user hanya boleh punya 1 baris untuk 1 menu
            $table->unique(['user_id', 'menu_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
