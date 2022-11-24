<?php

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
        Schema::create('specification_produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId("produit_id")->nullable()->constrained()->cascadeOnDelete();
            $table->float("width",10,3)->default(0);
            $table->float("height")->default(0);
            $table->float("depth")->default(0);
            $table->float("weight")->default(0);
            $table->text("consigne")->nullable();
            $table->date("peremtion")->default(now()->addYears(3));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specification_produits');
    }
};
