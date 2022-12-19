<?php

namespace Tests\Unit\Domains\Admin\Jobs;

use App\Data\Dto\UpdateAdminDto;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domains\Admin\Jobs\UpdateAdminJob;

/**
 *
 */
class UpdateAdminJobTest extends TestCase
{
    use WithFaker;

    /**
     * @return void
     */
    public function testUpdateAdminJob(): void
    {
        $admin = Admin::factory()->create();
        $dto =   UpdateAdminDto::makeByArray([
            'name'=>$this->faker->name,
            'email'=>$this->faker->safeEmail
        ]);
        $job = new UpdateAdminJob( $admin->id, $dto);

        $job->handle();

        $this->assertDatabaseHas('admins', [
            'id'=>$admin->id,
            'email'=>$dto->getEmail()
        ]);

        //$this->assertTrue(is_null($dto->getPassword()?->value));

    }
}
