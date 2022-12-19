<?php
declare(strict_types=1);

namespace App\Domains\Admin\Jobs;

use App\Data\Dto\CreateAdminDto;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

class CreateAdminJob extends Job
{
    private CreateAdminDto $createAdminDto;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CreateAdminDto $createAdminDto)
    {
        $this->createAdminDto = $createAdminDto;
    }

    /**
     * Execute the job.
     *
     * @return Model|Builder|Admin
     */
    public function handle():Admin
    {
        return Admin::query()
            ->create([
                'name'=>$this->createAdminDto->getName(),
                'email'=>$this->createAdminDto->getEmail(),
                'password'=>$this->createAdminDto->getPassword()
            ]);
    }
}
