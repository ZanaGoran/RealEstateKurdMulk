<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    
    
    
    public function up(): void
        {
            Schema::create('properties', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('location')->nullable();
                $table->double('lat', 10, 6)->nullable(); // Latitude column
                $table->double('lng', 10, 6)->nullable(); // Longitude column
                $table->string('type');
                $table->string('type_of_rent')->nullable();
                $table->integer('bedrooms')->nullable();
                $table->integer('bathrooms')->nullable();
                $table->integer('parking_spaces')->nullable();
                $table->integer('square_footage');
                $table->string('furnishing')->nullable();
                $table->string('flooring')->nullable();
                $table->string('water_supply')->nullable();
                $table->string('amenities')->nullable();
                $table->decimal('price', 10, 2);
                $table->string('currency')->nullable();
                $table->string('payment_frequency')->nullable();
                $table->json('photos');
                $table->json('videos')->nullable();
                $table->string('virtual_tour')->nullable();
                $table->text('additional_information')->nullable();
                $table->enum('status', ['pending', 'active'])->default('pending');
                $table->boolean('featured')->default(false);
                $table->boolean('highlighted')->default(false);
                $table->integer('views')->default(0);
                $table->integer('likes')->default(0);
                $table->integer('dislikes')->default(0);
                $table->json('comments')->nullable();
                $table->timestamps();
            });
        }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
           
        }
};
