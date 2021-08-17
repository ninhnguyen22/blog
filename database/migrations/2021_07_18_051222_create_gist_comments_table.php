<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGistCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gist_comments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('avatar_url')->nullable();
            $table->text('content');
            $table->timestamps();

            $table->foreignId('gist_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gist_comments');
    }
}
