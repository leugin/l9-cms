<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Dto\SearchAdmin;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HigherOrderWhenProxy;
use Lucid\Units\Job;

class FindAdminJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private readonly SearchAdmin $searchAdmin)
    {

    }

    /**
     * Execute the job.
     *
     * @return Admin|null
     */
    public function handle(): Admin|null
    {
        return Admin::query()
            ->when($this->searchAdmin->get('id'), function (Builder $query) {
                return $query->where('id', $this->searchAdmin->id);
            })
            ->when($this->searchAdmin->get('email'), function (Builder $query) {
                return $query->where('email', $this->searchAdmin->email);
            })
            ->first();
    }
}
