<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Middleware\StartSession;

class StartPustakawanSession extends StartSession
{
    public function handle($request, Closure $next, ...$guards)
    {
        config(['session.cookie' => 'perpus_pustakawan_session']);
        return parent::handle($request, $next, ...$guards);
    }
}
