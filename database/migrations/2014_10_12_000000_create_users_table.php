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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('referral_id')->nullable();
            $table->string('role_id')->nullable();
            $table->string('name');
            $table->string('username');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('birth_month')->nullable();
            $table->string('email')->unique();
            $table->string('verification_code')->nullable();
            $table->string('kc_token')->nullable();
            $table->string('status')->nullable();
            $table->string('campus')->nullable();
            $table->string('church')->nullable();
            $table->string('zone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $a = new \App\Models\User();
        $a->name = 'Administrator';
        $a->phone = '2348036910708';
        $a->image = 'admin.png';
        $a->email = 'admin@thewatchersnetwork.org';
        $a->username = 'admin';
        $a->password = bcrypt(123456);
        $a->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
