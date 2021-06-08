<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_estado_id')->default(1);
            $table->foreign('tipo_estado_id')->references('id')->on('tipo_estado')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_usuario_id')->nullable(true);
            $table->foreign('tipo_usuario_id')->references('id')->on('tipo_usuario')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_tipo_estado_id_foreign');
            $table->dropForeign('users_tipo_usuario_id_foreign');
        });
    }
}
