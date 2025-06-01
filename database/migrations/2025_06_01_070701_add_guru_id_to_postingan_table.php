<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuruIdToPostinganTable extends Migration
{
    public function up()
    {
        Schema::table('postingan', function (Blueprint $table) {
            $table->unsignedBigInteger('guru_id')->nullable()->after('admin_id');
            $table->foreign('guru_id')->references('guru_id')->on('guru')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('postingan', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
            $table->dropColumn('guru_id');
            $table->unsignedBigInteger('admin_id')->nullable(false)->change();
        });
    }
}