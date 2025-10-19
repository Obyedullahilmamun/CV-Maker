<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->text('references')->nullable()->after('skills');
        });
    }

    public function down()
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropColumn('references');
        });
    }
};
