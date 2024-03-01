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
        Schema::create('streams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link');
            $table->string('status');
            $table->timestamps();
        });
        $arr = [
            'ADAPTIVE STREAM' => 'https://vcpout-sf01-altnetro.internetmultimediaonline.org/ext/ext1.smil/playlist.m3u8',
            'PRAYERTHON' => 'https://vcpout-ams01.internetmultimediaonline.org/helloloveworld/prayerthon/playlist.m3u8',
            'NORMAL STREAM' => 'https://cdnstack.internetmultimediaonline.org/ceflixangles/31cf4f6883398b06c96ce12144fc7deb/playlist.m3u8',


        ];

        foreach($arr as $k => $v){
            $t = new \App\Models\Stream();
            $t->name = $k;
            $t->link = $v;
            $t->status = 'inactive';
            $t->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streams');
    }
};
