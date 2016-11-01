<?php

namespace LaravelApi\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use LaravelApi\Core\Database\Migration;

class CreatePasswordResetsTable extends Migration
{
    protected $table = 'password_resets';

    public function up()
    {
        $this->schema->create($this->table, function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        $this->schema->drop($this->table);
    }
}