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
        Schema::create('auditoria', function (Blueprint $table) {
            $table->id();
            $table->string('usuario',40)->comment('USUARIO QUE REALIZA LA ACCION');
            $table->string('correo',60)->comment('CORREO DE USUARIO QUE REALIZA LA ACCION');
            $table->string('observaciones',600)->comment('ACCION REALIZADA');
            $table->string('direccion_ip', 40)->comment('DIRECCION IP')->nullable();
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
        Schema::table('auditoria', function (Blueprint $table) {
            //
        });
    }
};
