<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPhotosTable extends Migration
{
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_card_id')->nullable();
            $table->foreign('contact_card_id', 'contact_card_fk_8002054')->references('id')->on('contact_cards');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8002058')->references('id')->on('users');
        });
    }
}
