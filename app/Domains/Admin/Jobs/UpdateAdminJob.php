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
    public function __construct(private readonly  int $id, private readonly UpdateAdminDto $updateAdminDto)
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

        $rf = new \ReflectionClass($this->updateAdminDto);
        $fields =  [];

        foreach ($rf->getProperties() as $value ) {
             if (!is_null($this->updateAdminDto->{$value->name})) {
                $fields[$value->name]= $this->updateAdminDto->{$value->name};
            }

        }
        return  $fields;
    }
}
