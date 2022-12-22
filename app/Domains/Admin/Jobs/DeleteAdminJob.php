<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Dto\UpdateAdminDto;
use App\Models\Admin;
use Lucid\Units\Job;

class DeleteAdminJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly  int $id)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return int
     */
    public function handle(): int
    {

        return Admin::query()
            ->where('id', $this->id)
            ->delete();
    }

}
