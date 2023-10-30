<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $customer = Customer::where("dni", $request->route('index'))->orWhere("email", $request->route('index'))->first();

        if 
        (
            ($request->method() === "GET" && $customer->status != "A") || 
            ($request->method() === "DELETE" && $customer->status == "trash")
        )
        {
            return response()->json([
                "status" => false,
                "error" => "Registro no existe",
            ], 400);
        }

        return $next($request);
    }
}
