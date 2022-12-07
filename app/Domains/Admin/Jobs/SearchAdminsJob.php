<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Dto\SearchAdmin;
use App\Models\Admin;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Lucid\Units\Job;

class SearchAdminsJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly ?SearchAdmin $filter = null)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return Builder
     */
    public function handle():Builder
    {
        $params = $this->filter ?? new SearchAdmin();
        return Admin::query()
            ->when($params->get('id'),
                function (Builder $query) use ($params)
                {
                    return $query->where('id', $params->get('id'));
                })
            ->when($params->get('excludeId'),
                function (Builder $query) use ($params)
                {
                    return $query->where('id', '<>',$params->get('excludeId'));
                })
            ;
    }
}
