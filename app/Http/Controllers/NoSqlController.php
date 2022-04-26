<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Zip;
use Illuminate\Support\Facades\Log;

class NoSqlController extends Controller
{
    public static function index(Request $r){

        // Log::info('index => ' . $r->id);

        $zip = Zip::find($r->id);


        if($zip){
            return $zip->data;
        }else{
            return response()->json(['error' => 'Zip Code Not found'], 404);
        }

        // return $zip->data;
    }
}
