<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Primary Key (ID)
            $table->unsignedBigInteger('user_id'); // User ID
            $table->string('name'); // Name of the requester
            $table->string('support_category'); // Support Category
            $table->string('issue'); // Issue title or short description
            $table->text('description'); // Detailed description of the issue
            $table->string('issue_source')->nullable(); // Source of the issue
            $table->string('image')->nullable(); // Path to the image (if any)
            $table->string('priority')->default('medium'); // Priority level
            $table->date('deadline')->nullable(); // Deadline for resolving the issue
            $table->string('departments')->nullable(); // Departments involved
            $table->string('assigned_to')->nullable(); // Assigned person or team
            
            // Custom timestamp columns
            $table->timestamps(); // Automatically creates 'created_at' and 'updated_at' columns

            // Soft deletes
            $table->softDeletes(); // Automatically creates 'deleted_at' column
            
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop foreign key
        });

        Schema::dropIfExists('tickets');
    }
}
