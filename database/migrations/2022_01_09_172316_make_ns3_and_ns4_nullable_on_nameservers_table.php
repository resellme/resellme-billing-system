<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeNs3AndNs4NullableOnNameserversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nameservers', function (Blueprint $table) {
            $table->string('ns3')->nullable()->change();
            $table->string('ns4')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nameservers', function (Blueprint $table) {
            //
        });
    }
}
