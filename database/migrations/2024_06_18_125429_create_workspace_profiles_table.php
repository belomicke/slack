<?php

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workspace_profiles', function (Blueprint $table) {
            $table->id();
            $table
                ->uuid('public_id')
                ->unique();

            $table
                ->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table
                ->foreignIdFor(Workspace::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('email');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('display_name');
            $table->string('title');

            $table->string('avatar_folder_name')->nullable();
            $table->integer('default_avatar_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspace_profiles');
    }
};
