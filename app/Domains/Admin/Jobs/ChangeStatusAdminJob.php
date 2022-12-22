<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Values\AdminStatus;
use App\Models\Admin;
use Lucid\Units\Job;

class ChangeStatusAdminJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $adminId, private readonly AdminStatus $status)
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
            ->where('id', $this->adminId)
            ->update([
                'status'=>$this->status->value
            ]);
    }
}
