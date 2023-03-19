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
       /*  Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',255);   
            $table->string('email',255);
            $table->string('password', 255);
            $table->integer('edad');
            $table->integer('sueldo');
            $table->timestamps();
        }); */
      

        DB::statement("CREATE TABLE usuarios(
            id int(255) auto_increment not null,
            nombre varchar(255),
            email varchar(255),
            password varchar(255),
            primary key(id)

        );");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       schema::drop('usuarios');
    }
};
