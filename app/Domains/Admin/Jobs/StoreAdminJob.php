<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Dto\CreateAdminDto;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

class StoreAdminJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly CreateAdminDto $createAdminDto)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return Model|Builder|Admin
     */
    public function handle(): Model|Builder|Admin
    {
        return Admin::query()
            ->create([
                'name'=>$this->createAdminDto->name,
                'email'=>$this->createAdminDto->email,
                'password'=>$this->createAdminDto->password
            ]);
    }
}
