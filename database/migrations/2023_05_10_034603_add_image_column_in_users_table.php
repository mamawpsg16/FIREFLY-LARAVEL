<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image_name', 255)->after('password')->nullable();
            $table->string('hash_image_name', 255)->after('image_name')->nullable();
            $table->string('image_path', 255)->after('has_image_name')->nullable();
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
            $table->dropColumn('image_name');
            $table->dropColumn('hash_image_name');
            $table->dropColumn('image_path');

        });
    }
}
