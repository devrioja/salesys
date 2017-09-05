<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class SearchLiveController extends Controller
{
    public function index(){

        return view('search');
        

    }

    public function query(Request $request){
        

        if ($request->ajax()){
            DB::connection()->enableQueryLog();
            $parametro = $request->input('parametro1');
            //$parametro = 'ha';
            $result = json_decode(DB::table('articles')->leftJoin('brands','articles.brand_id','=','brands.id',true)->select('articles.nombre as nombre','brands.nombre as nombrem','articles.id as id')->where('articles.nombre','LIKE','%'.$parametro.'%')->get());
            //echo $result[0]['nombre'];
            //echo $queries = DB::getQueryLog();
            //print_r($result);
            return response()->json($result,200); // This will dump and die

        }


    }
}
