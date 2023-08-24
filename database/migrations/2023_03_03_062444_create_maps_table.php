<?php

use App\Enums\ZoomLevel;
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
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->text('title')->comment('マップのタイトル');
            $table->text('description')->comment('マップの概要');
            $table->double('center_lat', 8, 6)->comment('中心の緯度');
            $table->double('center_lon', 9, 6)->comment('中心の経度');
            $table->integer('zoom_level')->default(ZoomLevel::DEFAULT)->comment('ズームレベル');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maps');
    }
};
