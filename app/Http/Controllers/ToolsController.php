<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Validator;

use App\Area;
use App\Tool;
use App\ToolType;
use App\Employee;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('order')){
            if(request('filter')){
                $tools = Tool::withCount(['contractTools' => function ($query) {
                    $query->where('status', '=', 1);
                }])->where(request('filter'), '=', request('value'))->orderBy(request('order'), 'asc')->get();
                foreach($tools as $key => $tool){
                    if($tool->contract_tools_count > 0)
                        $tool->load('toolTypes', 'contractTools');
                    else
                        unset($tools[$key]);
                }
                return $tools;
            }
            else {
                $tools = Tool::withCount(['contractTools' => function ($query) {
                    $query->where('status', '=', 1);
                }])->orderBy(request('order'), 'asc')->get();
                foreach($tools as $key => $tool){
                    if($tool->contract_tools_count > 0)
                        $tool->load('toolTypes', 'contractTools');
                    else
                        unset($tools[$key]);
                }
                return $tools;
            }
        }
        if(request('filter')){
            $tools = Tool::withCount(['contractTools' => function ($query) {
                $query->where('status', '=', 1);
            }])->where(request('filter'), '=', request('value'))->get();
            foreach($tools as $key => $tool){
                if($tool->contract_tools_count > 0)
                    $tool->load('toolTypes', 'contractTools');
                else
                    unset($tools[$key]);
            }
            return $tools;
        }
        $tools = Tool::withCount(['contractTools' => function ($query) {
            $query->where('status', '=', 1);
        }])->get();
        foreach($tools as $key => $tool){
            if($tool->contract_tools_count > 0)
                $tool->load('toolTypes', 'contractTools');
            else
                unset($tools[$key]);
        }
        return $tools;
    }

    public function main()
    {
    	$toolTypes = ToolType::all();
    	$areas = Area::all();
        $responsibles = Employee::all();
    	return view('tools/index')->with(['toolTypes' => $toolTypes, 'areas' => $areas]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:tools',
            'description' => 'required',
            'toolType_id' => 'required|exists:tool_types,id',
        ]);

        if($validation->fails()){
            return response()->json(['status' => 0, 'errors' => $validation->errors()]);
        }

        $tool = \App\Tool::create($request->all());

        return response()->json(['status' => 1, 'tool' => $tool]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->input, [
            'name' => [
                'required',
                Rule::unique('tools')->ignore($request->id)
            ],
            'description' => 'required',
            'toolType_id' => 'required|exists:tool_types,id'
        ]);

        if($validator->fails()){
            return response()->json(['status' => 0, 'errors' => $validator->errors()]);
        }
        else{
            $tool = \App\Tool::find($request->id)->update($request->input);
            return response()->json(['status' => 1]);
        }
    }

    public function destroy($id)
    {
        $tool = Tool::find($id);
        $tool->status = 0;
        $tool->update();
        return response()->json(['status' => 1]);
    }

    public function getFilteredTools(Request $request) {

    }

}