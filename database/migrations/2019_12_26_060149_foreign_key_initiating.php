<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyInitiating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('groups', function (Blueprint $table) {
            
            $table->foreign('created_by')->references('id')->on('users');
        });

        Schema::table('categories', function (Blueprint $table) {
            
            $table->foreign('created_by')->references('id')->on('users');
        });

        Schema::table('expenses', function (Blueprint $table) {
            
            $table->foreign('recepient_id')->references('id')->on('users');

            $table->foreign('category_id')->references('id')->on('categories');

            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::table('group_users', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::table('expense_splits', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('recepient_paid')->references('id')->on('users');

            $table->foreign('expense_id')->references('id')->on('expenses');

            $table->foreign('group_user_id')->references('id')->on('group_users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
