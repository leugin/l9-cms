<?php

namespace App\Services\Management\Console;

use App\Data\Dto\SearchAdmin;
use App\Domains\Admin\Jobs\FindAdminJob;
use App\Models\Admin;
use Illuminate\Console\Command;
use Lucid\Bus\ServesFeatures;

class CreateAdmin extends Command
{
    use ServesFeatures;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'management:admin:create {email} {password}  {--name=guest}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new admin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->option('name');

        /**@var Admin $exists*/
        $exists = $this->serve(FindAdminJob::class, [
            'searchAdmin'=>SearchAdmin::make(['email'=>$email])
        ])
        ;

        if ($exists) {
            $this->error("El correo  {$email} ya esta registrado id:". $exists->id);
            return 0;
        }

        /**@var Admin $admin*/

        $admin = Admin::query()->create([
            'email'=>$email,
            'password'=>$password,
            'name'=>$name
        ]);
        $this->info("usuario creado: {$admin->id}");
        return 0;
    }
}
