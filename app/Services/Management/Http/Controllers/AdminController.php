<?php

namespace App\Services\Management\Http\Controllers;

use App\Services\Management\Features\SearchAdminsFeature;
use App\Services\Management\Features\ShowAdminTableFeature;
use Lucid\Units\Controller;

class AdminController extends Controller
{

    public function index() {
        return $this->serve(ShowAdminTableFeature::class);
    }

    public function datatable() {
        return  $this->serve(SearchAdminsFeature::class);

    }
}
