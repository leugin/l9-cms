<?php

namespace App\Services\Management\Features;

use App\Data\Dto\SearchAdmin;
use App\Domains\Admin\Jobs\SearchAdminsJob;
use App\Models\Admin;
use App\Services\Management\Http\Resources\AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Lucid\Units\Feature;

class SearchAdminsFeature extends Feature
{
    public function handle(Request $request): AnonymousResourceCollection
    {
        /**@var Builder $builder*/
        $filter = SearchAdmin::make($request->all());
        $filter->excludeId = $request->user()->id;
        $builder = $this->run(SearchAdminsJob::class, [
            'filter'=>$filter
        ]);
        return AdminResource::collection($builder->paginate($filter->perPage));

    }
}
