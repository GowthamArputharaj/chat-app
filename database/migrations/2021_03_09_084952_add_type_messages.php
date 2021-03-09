<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('messages') && !Schema::hasColumn('messages', 'type')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->enum('type', ['group','private'])->default('private');
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
        if (Schema::hasTable('messages') && Schema::hasColumn('messages', 'type')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
}
