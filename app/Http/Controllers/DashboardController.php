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
    	$total = DB::table('tools')->get()->count();
    	$topPrice = DB::select("SELECT name, cost FROM licenses a JOIN tools b ON b.id=tool_id WHERE cost = (SELECT max(cost) FROM licenses);");
    	$lowPrice = DB::select("SELECT name, cost FROM licenses a JOIN tools b ON b.id=tool_id WHERE cost = (SELECT min(cost) FROM licenses WHERE cost > 0);");
    	$newer = DB::select("SELECT name, 'contract-date' FROM licenses a JOIN tools b ON b.id=tool_id WHERE 'contract-date' = (SELECT max('contract-date') FROM licenses);");
    	$older = DB::select("SELECT name, 'contract-date' FROM licenses a JOIN tools b ON b.id=tool_id WHERE 'contract-date' = (SELECT min('contract-date') FROM licenses);");
    	return response()->json([
    		'total' => $total,
    		'topPrice' => $topPrice,
    		'lowPrice' => $lowPrice,
    		'newer' => $newer,
    		'older' => $older
    	]);
    }

}
