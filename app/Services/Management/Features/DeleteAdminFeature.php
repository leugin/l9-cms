<?php

namespace App\Services\Management\Features;

use App\Domains\Admin\Jobs\DeleteAdminJob;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Lucid\Units\Feature;

class DeleteAdminFeature extends Feature
{
    private Admin $admin;

    /**
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return
     */
    public function handle()
    {

        $this->run(DeleteAdminJob::class, [
            'id'=>$this->admin->id
        ]);
        return  response()->json();
    }

}
