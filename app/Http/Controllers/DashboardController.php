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
    	$topPrice = DB::select('SELECT name, cost FROM tools JOIN tool_contracts ON id=tool_id WHERE cost = (SELECT max(cost) FROM tool_contracts);');
    	$lowPrice = DB::select('SELECT name, cost FROM tools JOIN tool_contracts ON id=tool_id WHERE cost = (SELECT min(cost) FROM tool_contracts WHERE cost > 0);');
    	$newer = DB::select('select name, contract_date from tools join tool_contracts on id=tool_id where contract_date = (select max(contract_date) from tool_contracts);');
    	$older = DB::select('select name, contract_date from tools join tool_contracts on id=tool_id where contract_date = (select min(contract_date) from tool_contracts);');
    	return response()->json([
    		'total' => $total,
    		'topPrice' => $topPrice,
    		'lowPrice' => $lowPrice,
    		'newer' => $newer,
    		'older' => $older
    	]);
    }

}
