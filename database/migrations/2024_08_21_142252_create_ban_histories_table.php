<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class CreateBanHistoriesTable extends Migration
    {
        public function up()
        {
            Schema::create('ban_histories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->text('ban_reason');
                $table->integer('ban_duration'); // In days
                $table->dateTime('banned_until')->nullable();
                $table->boolean('is_active')->default(true); // Indicates if the ban is currently active
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('ban_histories');
        }
    }
    