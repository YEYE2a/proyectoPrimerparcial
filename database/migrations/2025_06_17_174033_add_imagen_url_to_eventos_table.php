<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenUrlToEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('eventos', function (Blueprint $table) {
        $table->string('imagen_url')->nullable()->after('lugar');
    });
}

public function down()
{
    Schema::table('eventos', function (Blueprint $table) {
        $table->dropColumn('imagen_url');
    });
}
}
