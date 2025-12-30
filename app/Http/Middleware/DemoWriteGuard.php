<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoWriteGuard
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!config('app.demo')) {
            return $next($request);
        }

        $actionMethod = $request->route()?->getActionMethod();
        $blockedActions = ['edit', 'update', 'destroy'];
        $blockedMethods = ['PUT', 'PATCH', 'DELETE'];

        if (in_array($request->method(), $blockedMethods, true)
            || in_array($actionMethod, $blockedActions, true)) {
            $message = 'Mode démo : la modification et la suppression des données existantes sont désactivées.';

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 403);
            }

            return redirect()->back()->with('error', $message);
        }

        return $next($request);
    }
}
