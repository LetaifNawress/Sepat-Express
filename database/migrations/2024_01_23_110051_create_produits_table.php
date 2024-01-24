<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateProduitsTable extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Name');
            $table->string('Marque');
            $table->string('Quantite');
            $table->string('couleur');
            $table->integer('Prix');
            $table->string('type');
            $table->binary('image');
            $table->string('reference')->default(Str::uuid());
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
