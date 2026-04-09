<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreIntendedAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {

            session([
                'intended_action' => [
                    'type' => $request->has('buy_now') ? 'buy_now' : 'add_to_cart',
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity ?? 1,
                ]
            ]);

            return redirect()->route('login');
        }

        return $next($request);
    }
}
