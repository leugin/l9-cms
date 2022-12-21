<?php

namespace Tests\Unit\Domains\Admin\Jobs;

use App\Data\Dto\CreateAdminDto;
use App\Domains\Admin\Jobs\StoreAdminJob;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateAdminJobTest extends TestCase
{
    use WithFaker;
    public function testCreateAdminJob()
    {
        $createAdminDto =  CreateAdminDto::makeByArray([
            'name'=>$this->faker->name,
            'email'=>$this->faker->safeEmail,
            'password'=>$this->faker->password
        ]);


        $job = new  StoreAdminJob($createAdminDto);
        $job->handle();

        $this->assertDatabaseHas('admins', [
            'email'=>$createAdminDto->email
        ]);



    }
}
