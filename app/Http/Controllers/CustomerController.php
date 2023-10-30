<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Commune;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        try {
            $data = Customer::select('customers.name', 'customers.last_name', 'customers.address', 'regions.description as region', 'communes.description as commune')
                            ->join('regions', 'regions.id', 'customers.region_id')
                            ->join('communes', 'communes.id', 'customers.commune_id')
                            ->where('customers.status', 'A')
                            ->get();

            return response()->json([
                "status" => true,
                "data" => $data,
            ], 200);
        } 
        catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $data = Customer::select('customers.name', 'customers.last_name', 'customers.address', 'regions.description as region', 'communes.description as commune')
                            ->join('regions', 'regions.id', 'customers.region_id')
                            ->join('communes', 'communes.id', 'customers.commune_id')
                            ->where('customers.status', 'A')
                            ->where('customers.dni', $request->input("dni"))
                            ->orWhere('customers.email', $request->input("email"))
                            ->first();

            return response()->json([
                "status" => true,
                "data" => $data,
            ], 200);
        } 
        catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $customer = new Customer([
                "dni"        => $request->input("dni"),
                "region_id"  => Region::findOrFail($request->input("region"))->id,
                "commune_id" => Commune::findOrFail($request->input("commune"))->id,
                "email"      => $request->input("email"),
                "name"       => $request->input("name"),
                "last_name"  => $request->input("last_name"),
                "address"    => $request->input("address"),
            ]);
            if ($customer->save()) {
                return response()->json([
                    "status" => true,
                    "message" => "Customer created successfully",
                ], 200);
            }

            
        } 
        catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
            ], 500);
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->update(["status" => "trash"]);
            return response()->json([
                "status" => true,
                "message" => "Customer deleted successfully",
            ], 200);
        } 
        catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
            ], 500);
        }
    }
}
