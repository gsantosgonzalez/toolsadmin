<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Computer;
use App\Currency;
use App\Employee;
use App\Frecuency;
use App\Paymethod;


class CatalogsController extends Controller
{

    public function addArea(Request $request){
        $area = new Area($request->all());
        if ( $area->save() ){
            return response()->json(['status' => 1, 'message' => 'Se guardó correctamente']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Ha ocurrido un error']);
        }
    }

    public function addComputer(Request $request){
        $computer = new Computer($request->all());
        if ( $computer->save() ){
            return response()->json(['status' => 1, 'message' => 'Se guardó correctamente']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Ha ocurrido un error']);
        }
    }

    public function addCurrency(Request $request){
        $currency = new Currency($request->all());
        if ( $currency->save() ){
            return response()->json(['status' => 1, 'message' => 'Se guardó correctamente']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Ha ocurrido un error']);
        }
    }

    public function addEmployee(Request $request){
        $employee = new Employee($request->all());
        if ( $employee->save() ){
            return response()->json(['status' => 1, 'message' => 'Se guardó correctamente']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Ha ocurrido un error']);
        }
    }

    public function addFrecuency(Request $request){
        $frecuency = new Frecuency($request->all());
        if ( $frecuency->save() ){
            return response()->json(['status' => 1, 'message' => 'Se guardó correctamente']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Ha ocurrido un error']);
        }
    }

    public function addPaymethod(Request $request){
        $paymethod = new Paymethod($request->all());
        if ( $paymethod->save() ){
            return response()->json(['status' => 1, 'message' => 'Se guardó correctamente']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Ha ocurrido un error']);
        }
    }

}
