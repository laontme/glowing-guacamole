<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('token', function (Request $request) {
            if (!$request->session()->has('token')) {
                return null;
            }

            $token = decrypt($request->session()->get('token'));
            $res = Http::jg($token)->get('/user');

            if ($res->ok()) {
                $data = $res->json()['data'];
                return collect([
                    'data' => $data,
                    'token' => $token,
                ]);
            }

            return null;
        });
    }
}
