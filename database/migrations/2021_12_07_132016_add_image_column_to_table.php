<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageColumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->after('updated_at', function ($table){
                $table->string('image')->nullable();
                $table->string('pending')->nullable();
                $table->string('revise')->nullable();
                $table->mediumText('revise_reason')->nullable();
                $table->string('reject')->nullable();
                $table->mediumText('reject_reason')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->after('updated_at', function ($table){
                $table->string('image')->nullable();
                $table->string('pending')->nullable();
                $table->string('revise')->nullable();
                $table->mediumText('revise_reason')->nullable();
                $table->string('reject')->nullable();
                $table->mediumText('reject_reason')->nullable();
            });
        });
    }
}
