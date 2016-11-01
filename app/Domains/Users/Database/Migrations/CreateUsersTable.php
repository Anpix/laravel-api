<?php

namespace LaravelApi\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use LaravelApi\Core\Database\Migration;

class CreateUsersTable extends Migration
{
    protected $table = 'users';

    public function up()
    {
        $this->schema->create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->drop($this->table);
    }
}