<?php

namespace Tests\Unit\Domains\Admin\Jobs;

use App\Data\Values\AdminStatus;
use App\Models\Admin;
use Tests\TestCase;
use App\Domains\Admin\Jobs\ChangeStatusAdminJob;

class ChangeStatusAdminJobTest extends TestCase
{
    public function test_change_status_admin_job()
    {
        $admin = Admin::factory()->create();
        $job= new ChangeStatusAdminJob($admin->id, AdminStatus::DISABLED);
        $result = $job->handle();
        $this->assertTrue( $result== 1, "se actualizaron {$result}" );

        $this->assertDatabaseHas('admins', [
            'id'=>$admin->id,
            'status'=>AdminStatus::DISABLED->value
        ]);
    }
}
