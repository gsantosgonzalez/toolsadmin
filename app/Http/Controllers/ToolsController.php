<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Area;
use App\Tool;
use App\Type;
use App\Responsible;
use App\Http\Requests\ToolRequest;

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
                $tools = Tool::where(request('filter'), '=', request('value'))->orderBy(request('order'), 'asc')->get();
                $tools->load('area', 'type', 'responsible');
                return $tools;
            }
            else {
                $tools = Tool::orderBy(request('order'), 'asc')->get();
                $tools->load('area', 'type', 'responsible');
                return $tools;
            }
        }
        if(request('filter')){
            $tools = Tool::where(request('filter'), '=', request('value'))->get();
            $tools->load('area', 'type', 'responsible');
            return $tools;
        }
        $tools = Tool::all();
        $tools->load('area', 'type', 'responsible');
        return $tools;
    }

    public function main()
    {
    	$types = Type::all();
    	$areas = Area::all();
        $responsibles = Responsible::all();
    	return view('tools/index')->with(['types' => $types, 'areas' => $areas]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:tools',
            'description' => 'required',
            'type_id' => 'required|exists:types,id',
            'area_id' => 'required|exists:areas,id',
            'responsible_id' => 'required|exists:responsibles,id'
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
            'name' => 'required|unique:tools',
            'description' => 'required',
            'type_id' => 'required|exists:types,id',
            'area_id' => 'required|exists:areas,id',
            'responsible_id' => 'required|exists:responsibles,id'
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
        Tool::find($id)->delete();
        return response()->json(['status' => 1]);
    }

}