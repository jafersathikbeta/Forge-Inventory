<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('permissions')->where('name', 'users.transfer_ownership')->update(['name' => 'users.ownership.transfer']);
    }

    public function down(): void
    {
        DB::table('permissions')->where('name', 'users.ownership.transfer')->update(['name' => 'users.transfer_ownership']);
    }
};
