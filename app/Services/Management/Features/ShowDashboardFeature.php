<?php

namespace App\Services\Management\Features;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

/**
 * Render tht dashboard
 */
class ShowDashboardFeature extends Feature
{
    /**
     * @return Response
     */
    public function handle(): Response
    {
        return Inertia::render('Management/Sections/Dashboard/Index', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }
}
