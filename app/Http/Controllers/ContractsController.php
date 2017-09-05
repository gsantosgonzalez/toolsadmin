<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ContractTool;

class ContractsController extends Controller
{
    public function getAll(){
    	$contracts = ContractTool::all();
    	$contracts->load('tool', 'area', 'frecuency', 'currency', 'card');
    	return $contracts;
    }

    public function getByTool(Request $request){
    	$contracts = ContractTool::where('tool_id', '=', request('id'))->get();
    	$contracts->load('tool', 'area', 'frecuency', 'currency', 'card');
    	return $contracts;
    }

    public function getByArea(Request $request){
    	$contracts = ContractTool::where('area_id', '=', request('id'))->get();
    	$contracts->load('tool', 'area', 'frecuency', 'currency', 'card');
    	return $contracts;
    }

}
