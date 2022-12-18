<?php

namespace App\Data\Repository;

use App\Data\Dto\TableAction;
use App\Foundation\Modules\Data\Contracts\Modulable;
use App\Foundation\Modules\Data\Dto\ModuleAction;
use App\Foundation\Modules\Data\Dto\Module;
use App\Foundation\Modules\Data\Dto\SearchModule;
use App\Foundation\Modules\Data\Factory\Action;
use App\Foundation\Modules\Data\Repository\ModuleRepository;
use App\Models\Admin;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 *
 */
class EloquentModuleRepository implements ModuleRepository
{
    /**
     *
     */
    const MODULE_CACHE = 'module-cache';

    /**
     * @return array|Modulable[]
     */
    public function all(): array
    {
        return  Cache::get(self::MODULE_CACHE, []);
    }

    /**
     * @param Modulable $modulable
     * @return bool
     */
    public function store(Modulable $modulable): bool
    {
        $current = Cache::get(self::MODULE_CACHE, []);
        $current[]= $modulable;
        Cache::put(self::MODULE_CACHE, $current);
        return  Cache::has(self::MODULE_CACHE);
    }

    /**
     * @return bool
     */
    public function clear(): bool
    {
        Cache::put(self::MODULE_CACHE, []);
        return  Cache::has(self::MODULE_CACHE);
    }

    /**
     * @param SearchModule $search
     * @return Modulable|null
     */
    public function findOne(SearchModule $search): ?Modulable
    {
        /**@var Modulable $value**/
        $current = collect(Cache::get(self::MODULE_CACHE));
        return $current
            ->when(!is_null($search->moduleKey),
                function (Collection $collection ) use ( $search )
                {
                    return $collection->filter(fn (Modulable $value) => $search->moduleKey == $value->getModuleKey());
                }
            )->first();
    }
}
