<?php

namespace App\Domains\Permission\Jobs;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;
use Spatie\Permission\Models\Permission;

class CreateOrFirstPermissionJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private readonly string $name,
        private readonly string $guard
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return Builder|Model
     */
    public function handle(): Model|Builder
    {
        return Permission::query()
            ->firstOrCreate([
                'name'=>$this->name,
                'guard_name'=>$this->guard
            ], [
                'name'=>$this->name,
                'guard_name'=>$this->guard
            ])
            ;
    }
}
