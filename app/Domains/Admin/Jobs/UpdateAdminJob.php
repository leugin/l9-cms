<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Dto\UpdateAdminDto;
use App\Models\Admin;
use Lucid\Units\Job;

class UpdateAdminJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private int $id, private  UpdateAdminDto $updateAdminDto)
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
        $fields = $this->getFields();
        info("ori", $this->updateAdminDto->toArray());
        info("fieles", $fields);
        return Admin::query()
            ->where('id', $this->id)
            ->update($fields);
    }

    private function getFields(): array {



        return  array_filter([
            'name'=>$this->updateAdminDto->getName(),
            'email'=>$this->updateAdminDto->getEmail(),
            'password'=>$this->updateAdminDto->getPassword()

        ], function ($val) { return !is_null($val);});
    }
}
