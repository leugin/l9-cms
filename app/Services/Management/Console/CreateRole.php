<?php

namespace App\Services\Management\Console;

use App\Models\Admin;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'management:role:create {name} {--guard=admin}'
    ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new role';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $guard = $this->option('guard');
        $name = $this->argument('name');

        /**@var Role $exists*/
        $exists = Role::query()
            ->where('name', $name)
            ->first()
        ;

        if ($exists)
        {
            $this->error("El roll  {$name} ya esta registrado id:". $exists->id);
            return 0;
        }

        /**@var Role $admin*/
        $role = Role::query()->create([
            'name'=>$name,
            'guard_name'=>$guard
        ]);
        $this->info("role creado: {$role->id}");
        return 0;
    }
}
