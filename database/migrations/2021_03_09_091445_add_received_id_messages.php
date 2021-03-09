<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReceivedIdMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('messages') && !Schema::hasColumn('messages', 'received_id')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->integer('received_id')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('messages') && Schema::hasColumn('messages', 'received_id')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->dropColumn('received_id');
            });
        }
    }
}
