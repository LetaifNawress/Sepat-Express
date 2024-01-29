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
            $table->unsignedBigInteger('vendeur_id')->nullable();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->string('Name');
            $table->string('Marque');
            $table->string('Quantite');
            $table->string('couleur');
            $table->string('description');
            $table->integer('Prix');
            $table->integer('nbvente');
            $table->String('image');
            $table->string('reference')->default(Str::uuid());
            $table->boolean('is_popular')->default(false);

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
        
    }
}
