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
    	$topPrice = DB::select('SELECT name, license_cost FROM tools a JOIN contract_tools b ON b.id=tool_id WHERE license_cost = (SELECT max(license_cost) FROM contract_tools);');
    	$lowPrice = DB::select('SELECT name, license_cost FROM tools a JOIN contract_tools b ON b.id=tool_id WHERE license_cost = (SELECT min(license_cost) FROM contract_tools WHERE license_cost > 0);');
    	$newer = DB::select('SELECT name, contract_date FROM tools a JOIN contract_tools b ON b.id=tool_id WHERE contract_date = (SELECT max(contract_date) FROM contract_tools);');
    	$older = DB::select('SELECT name, contract_date FROM tools a JOIN contract_tools b ON b.id=tool_id WHERE contract_date = (SELECT min(contract_date) FROM contract_tools);');
    	return response()->json([
    		'total' => $total,
    		'topPrice' => $topPrice,
    		'lowPrice' => $lowPrice,
    		'newer' => $newer,
    		'older' => $older
    	]);
    }

}
