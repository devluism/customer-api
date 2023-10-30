<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Commune;
use DB;
use Illuminate\Http\Request;
use Validator;

class CommuneController extends Controller
{
    public function index()
    {
        try {
            $communes = Commune::with('region.description')->get();
            return response()->json($communes, 200);
        } 
        catch (\Throwable $th) {
            abort(404, $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                "description" => "required|string|min:1|max:90",
                "region_id"   => "required|numeric"
            ];

            $validator = Validator::make($request->input(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "error" => $validator->errors()->all(),
                ], 400);
            }
            $commune = Commune::create($request->all());
            return response()->json([
                "status" => true,
                "message" => "Commune created successfully",
            ], 200);
        } 
        catch (\Throwable $th) {
            abort(404, $th->getMessage());
        }
    }

    public function show(Commune $commune)
    {
        try {
            return response()->json([
                "status" => true,
                "data" => $commune,
            ], 200);
        } 
        catch (\Throwable $th) {
            abort(404, $th->getMessage());
        }
    }

    public function update(Request $request, Commune $commune)
    {
        try {
            $rules = [
                "description" => "required|string|min:1|max:90",
                "region_id"   => "required|numeric"
            ];

            $validator = Validator::make($request->input(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "error" => $validator->errors()->all(),
                ], 400);
            }
            $commune->update($request->input());
            return response()->json([
                "status" => true,
                "message" => "Commune updated successfully",
            ], 200);
        } 
        catch (\Throwable $th) {
            abort(404, $th->getMessage());
        }
    }

    public function destroy(Commune $commune)
    {
        try {
            $commune->delete();
            return response()->json([
                "status" => true,
                "message" => "Commune deleted successfully",
            ], 200);
        } 
        catch (\Throwable $th) {
            abort(404, $th->getMessage());
        }
    }
}
