<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_id')->constrained('maps')->comment('マップID');;
            $table->string('title')->comment('ピンのタイトル');
            $table->string('description')->default('')->comment('ピンの概要');
            $table->double('lat', 8, 6)->comment('緯度');
            $table->double('lon', 9, 6)->comment('経度');
            $table->timestamps();

            $table->index(['map_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('pins', function (Blueprint $table) {
            $table->dropForeign(['map_id']);
        });

        Schema::dropIfExists('pins');
    }
};
