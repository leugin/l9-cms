<?php

namespace App\Services\Management\Operations;

use App\Foundation\Modules\Data\Contracts\Modulable;
use App\Foundation\Modules\Data\Dto\SearchModule;
use App\Foundation\Modules\Data\Repository\ModuleRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Lucid\Units\Operation;
use ReflectionException;

class LoadModulesOperation extends Operation
{
    const IGNORE_FOLDER= [
        '.',
        '..',
        'vendor'
    ];

    /**
     * Create a new operation instance.
     *
     * @return void
     */
    public function __construct(private readonly string $path)
    {
        //
    }

    /**
     * Execute the operation.
     *
     * @param ModuleRepository $repository
     * @return array
     * @throws BindingResolutionException|ReflectionException
     */
    public function handle(ModuleRepository $repository):array
    {
        $repository->clear();
        $path = base_path($this->path);
        $modules =   $this->scanPath($path);
        foreach ($modules as $module)
        {
            $find = new SearchModule(moduleKey:  $module->getModuleKey());
            if (is_null($repository->findOne($find)))
            {
                $repository->store($module);
            }
        }
        return  $modules;
    }

    /**
     * @return Modulable[]
     * @throws BindingResolutionException
     * @throws ReflectionException
     */
    private function scanPath(string $path): array {
        $modules = [];
        $files = scandir($path);
        foreach ($files as $file) {

            if (!in_array($file, self::IGNORE_FOLDER)){
                $full = $path.'/'.$file;
                if (is_dir($full))
                {
                    $modules = array_merge($this->scanPath($full), $modules) ;
                }
                else
                {
                    $classPath = $this->getClassPath($full);
                    if (class_exists($classPath) && $this->isModulable($classPath) )
                    {
                        $modules[] = new  $classPath;

                    }
                }
            }
        }
        return  $modules;
    }

    /**
     * @throws ReflectionException
     */
    public function isModulable(string $classPath): bool
    {
        return  (new \ReflectionClass($classPath))
            ->implementsInterface(Modulable::class);
    }
    /**
     * @param string $full
     * @return array|string|string[]
     */
    public function getClassPath(string $full): string|array
    {
        $classPath = str_replace(base_path(), '', $full);
        $classPath = str_replace('.php', '', $classPath);
        $classPath = str_replace('/app', 'App', $classPath);
        return str_replace('/', '\\', $classPath);
    }
}
