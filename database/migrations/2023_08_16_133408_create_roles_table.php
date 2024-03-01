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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name');
            $table->timestamps();
        });
        $arr = [
            'user' => 'PARTICIPANT',
            'influencer' => 'INFLUENCER',
        ];

        foreach($arr as $k => $v){
            $t = new \App\Models\Role();
            $t->name = $k;
            $t->display_name = $v;
            $t->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
