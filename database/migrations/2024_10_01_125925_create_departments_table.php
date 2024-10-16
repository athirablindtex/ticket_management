<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name')->unique(); // Name of the department (must be unique)
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); // Soft delete functionality
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
