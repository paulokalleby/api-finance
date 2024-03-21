<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->foreignUuid('user_id')
                    ->index()
                    ->cascadeOnDelete();
            $table->foreignUuid('account_id')
                    ->index()
                    ->cascadeOnDelete();
            $table->string('name', 50);
            $table->string('summary', 100);
            $table->enum('type', ['input', 'output']);
            $table->double('cost', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
