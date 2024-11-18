<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);                         // Full name of the user (Required)
            $table->string('phone', 20)->nullable();             // Phone number (Optional)
            $table->string('email', 255)->unique();              // Email address (Unique, Required)
            $table->string('username', 255)->unique();           // Username for login (Unique, Required)
            $table->string('password', 255);                     // User password (hashed) (Required)
            $table->date('date_of_birth')->nullable();           // Date of birth (Optional)
            $table->date('work_joined')->nullable();             // Date when the user joined work (Optional)
            $table->unsignedBigInteger('department_id')->nullable(); // Foreign key to departments table
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');     // Department name (Optional)
            $table->string('designation', 255)->nullable();      // Job title or role (Optional)
            $table->string('photo', 255)->nullable();            // File path or URL of the user’s photo (Optional)
            $table->unsignedBigInteger('created_by')->nullable();// Foreign key (ID of user who created the record)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();                               // Auto-generated created_at and updated_at
            $table->string('role', 50)->nullable(); 
                      // User's role (Optional, e.g., super_admin, admin, user)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

