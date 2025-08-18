<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Middleware\StartSession;

class StartAdminSession extends StartSession
{
    public function handle($request, Closure $next, ...$guards)
    {
        config(['session.cookie' => 'perpus_admin_session']);
        return parent::handle($request, $next, ...$guards);
    }
}
