<?php

namespace App\Services\Management\Console;


use App\Foundation\Modules\Data\Contracts\Modulable;
use App\Foundation\Modules\Data\Contracts\ModulableMenu;
use App\Foundation\Modules\Data\Dto\SearchModule;
use App\Foundation\Modules\Data\Repository\ModuleRepository;
use App\Services\Management\Operations\SetPermissionToAdminOperation;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Lucid\Bus\ServesFeatures;
use stdClass;

class LoadModuleCommand extends Command
{
    use ServesFeatures;
    const IGNORE_FOLDER= [
        '.',
        '..',
        'vendor'
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'management:core:load-modules {dir}'
    ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new super admin';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws BindingResolutionException
     */
    public function handle(ModuleRepository $repository): int
    {

        $repository->clear();

        $dir = $this->argument('dir');
        $path = base_path($dir);
        $this->info("scan for root {$path}");
        $modules =   $this->scanPath($path);
        foreach ($modules as $module) {
            $find = new SearchModule(moduleKey:  $module->getModuleKey());
            if (is_null($repository->findOne($find))){
                $repository->store($module);
            }
        }
        print_r($repository->all());


        return 0;
    }

    /**
     * @return Modulable[]
     * @throws BindingResolutionException
     */
    private function scanPath(string $path): array {
        $modules = [];
        $files = scandir($path);
        foreach ($files as $file) {

            if (!in_array($file, self::IGNORE_FOLDER)){
                $full = $path.'/'.$file;
                if (is_dir($full)) {
                    $modules = array_merge($this->scanPath($full), $modules) ;
                } else {
                    $this->info("file: ".$file, true);
                    $this->info("path: ".$full , true);
                    $classPath = $this->getClassPath($full);
                    $this->info('is_class: '.$classPath, true);
                    if (class_exists($classPath)) {
                        $rf = new \ReflectionClass($classPath);
                        if ($rf->implementsInterface(Modulable::class))
                        {
                            /**@var Modulable $instance*/
                             $modules[] = new  $classPath;
                        }

                    }
                }
            }

        }
        return  $modules;
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
        $classPath = str_replace('/', '\\', $classPath);
        return $classPath;
    }
}
