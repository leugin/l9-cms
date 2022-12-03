<?php

namespace App\Services\Management\Console;

use App\Models\Admin;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
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
        $exists = Admin::query()
            ->where('email', $email)
            ->first()
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
