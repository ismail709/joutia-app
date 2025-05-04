<?php

use App\Models\Ad;
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
        Schema::create('ad_views',function (Blueprint $table){
            $table->id();
            $table->foreignIdFor(Ad::class)->constrained()->cascadeOnDelete();
            $table->string('session_id');
            $table->timestamps();
            $table->unique(['ad_id','session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_views');
    }
};
