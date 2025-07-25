<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonies', static function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')
                ->unsigned()
                ->index()
                ->default(1);
            $table->string('name');
            $table->string('product')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->string('slug')
                ->unique()
                ->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
