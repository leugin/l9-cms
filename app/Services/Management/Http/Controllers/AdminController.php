<?php

namespace App\Services\Management\Http\Controllers;

use App\Models\Admin;
use App\Services\Management\Features\CreateAdminFormFeature;
use App\Services\Management\Features\EditAdminFormFeature;
use App\Services\Management\Features\SearchAdminsFeature;
use App\Services\Management\Features\ShowAdminTableFeature;
use App\Services\Management\Features\StoreAdminFeature;
use App\Services\Management\Features\UpdateAdminFeature;
use Lucid\Units\Controller;

class AdminController extends Controller
{

    public function index() {
        return $this->serve(ShowAdminTableFeature::class);
    }

    public function datatable() {
        return  $this->serve(SearchAdminsFeature::class);

    }
    public function edit(Admin $admin) {
        return  $this->serve(EditAdminFormFeature::class, [
            'admin'=>$admin
        ]);
    }
    public function store() {
        return  $this->serve(StoreAdminFeature::class);
    }
    public function update(Admin $admin) {
        return  $this->serve(UpdateAdminFeature::class, [
            'admin'=>$admin

        ]);
    }
    public function create() {
        return  $this->serve(CreateAdminFormFeature::class);

    }
}
