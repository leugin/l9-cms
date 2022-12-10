<?php

namespace App\Services\Management\Console;

use App\Domains\Permission\Jobs\CreateOrFirstPermissionJob;
use App\Foundation\Modules\Data\Repository\ModuleRepository;
use App\Models\Admin;
use App\Services\Management\Operations\SetPermissionToAdminOperation;
use Illuminate\Console\Command;
use Lucid\Bus\ServesFeatures;

class SetPermissionToAdmin extends Command
{
    use ServesFeatures;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'management:admin:assign {email} {--all=false}'
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
     */
    public function handle(): int
    {
       $this->serve(SetPermissionToAdminOperation::class, [
           'email'=>$this->argument('email'),
           'all'=>$this->option('all')
       ]);

        return 0;
    }
}
