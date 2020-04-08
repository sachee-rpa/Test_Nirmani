<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DynamicSelectController extends Controller
{
    function index(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        $tableData =  DB::table(explode('_id',$dependent)[0].'s')
        ->select('id','name as text')->where($select, $value)->get();
        return $tableData;
        return ['results' => $tableData] ;
    }
}
