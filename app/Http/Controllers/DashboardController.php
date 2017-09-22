<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(){
    	return view('dashboard.index');
    }

    public function getTops(){
        $filters = [];
        if(request('filter')){
            $filters[] = [request('filter'), '=', request('value')];
        }
        //dd($filters);
    	$total = DB::table('tools')->where($filters)->get()->count();
    	$topPrice = DB::table('licenses as a')->join('tools as b', 'b.id', '=', 'tool_id')->select('name', DB::raw('max(cost) as cost'))->where($filters)->groupBy('name')->get();
    	$lowPrice = DB::table('licenses as a')->join('tools as b', 'b.id', '=', 'tool_id')->select('name', DB::raw('min(cost) as cost'))->where($filters)->where('cost', '>', 0)->groupBy('name')->get();
    	$newer = DB::table('licenses as a')->join('tools as b', 'b.id', '=', 'tool_id')->select('name', DB::raw('max(contract_date) as date'))->where($filters)->groupBy('name')->get();
    	$older = DB::table('licenses as a')->join('tools as b', 'b.id', '=', 'tool_id')->select('name', DB::raw('min(contract_date) as date'))->where($filters)->groupBy('name')->get();
    	return response()->json([
    		'total' => $total,
    		'topPrice' => $topPrice,
    		'lowPrice' => $lowPrice,
    		'newer' => $newer,
    		'older' => $older
    	]);
    }

}
