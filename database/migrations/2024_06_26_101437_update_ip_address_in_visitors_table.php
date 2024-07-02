<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIpAddressInVisitorsTable extends Migration
{
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('ip_address', 45)->change();
        });
    }

    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('ip_address')->change();
        });
    }
}

