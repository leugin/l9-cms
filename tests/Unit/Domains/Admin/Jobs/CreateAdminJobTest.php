<?php

namespace Tests\Unit\Domains\Admin\Jobs;

use App\Data\Dto\CreateAdminDto;
use App\Domains\Admin\Jobs\CreateAdminJob;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateAdminJobTest extends TestCase
{
    use WithFaker;
    public function testCreateAdminJob()
    {
        $createAdminDto =  new CreateAdminDto(
            $this->faker->name,
            $this->faker->safeEmail,
            $this->faker->password
        );


        $job = new  CreateAdminJob($createAdminDto);
        $job->handle();

        $this->assertDatabaseHas('admins', [
            'email'=>$createAdminDto->getEmail()
        ]);



    }
}

