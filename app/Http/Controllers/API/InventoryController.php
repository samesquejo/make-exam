<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\ModelFactory as MF;

class InventoryController extends Controller
{
    public function index() {
        return response()->json("Hello", 200);
    }

    public function getInventory(Request $request) {

        $query = MF::model('inventory')->get();

        return response()->json(['data' => $query], 200);
    }

    public function createInventory(Request $request) {

        $query = MF::model('inventory')->create($request->all());

        return response()->json(['data' => $query], 200);
    }

    public function updateInventory(Request $request) {
        $query = MF::model('inventory')->find($request->id)->update($request->all());
        return response()->json(['data' => $query], 200);
    }
    
    public function deleteInventory(Request $request) {
        $query = MF::model('inventory')->find($request->id)->delete();
        return response()->json(['data' => $query], 200);
    }
}