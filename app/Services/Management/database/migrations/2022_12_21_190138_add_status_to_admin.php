<?php

use App\Data\Values\AdminStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up():void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('status', 100)
                ->default(AdminStatus::ACTIVE->value)
                ->index('index_admin_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropIndex('index_admin_status');
            $table->dropColumn('status');
        });
    }
};
