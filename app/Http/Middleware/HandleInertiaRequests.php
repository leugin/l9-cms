<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Operations\GetMenusOperation;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Lucid\Bus\ServesFeatures;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    use ServesFeatures;
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        /**@var Admin $user*/
        $user = $request->user('admin');
        $menus = $this->serve(GetMenusOperation::class, [
            'user'=>$user
        ]);


        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user,
                'menus'=>$menus,
                'permissions'=>$user ? $user->getAllPermissions()->pluck('name')->toArray(): []
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            }
        ]);
    }
}
