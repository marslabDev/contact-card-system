<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCardsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url_slug')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name');
            $table->string('company_position');
            $table->string('company_website');
            $table->string('email');
            $table->string('handphone_number');
            $table->string('office_phone_number');
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('wechat')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('douyin')->nullable();
            $table->string('xiao_hong_shu')->nullable();
            $table->string('slogan')->nullable();
            $table->string('mission')->nullable();
            $table->string('vision')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
