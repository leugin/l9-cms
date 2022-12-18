<?php

namespace App\Services\Management\Console;


use App\Services\Management\Operations\LoadModulesOperation;
use Illuminate\Console\Command;
use Lucid\Bus\ServesFeatures;
use stdClass;

class LoadModuleCommand extends Command
{
    use ServesFeatures;

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
    protected $description = 'load new modules';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

       $this->serve(LoadModulesOperation::class, [
           'path'=>$this->argument('dir')
       ]);

        return 0;
    }

}
