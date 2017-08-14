<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Type;
use App\Area;
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
        $tools = Item::latest()->paginate(5);
        $response = [
            'pagination' => [
                'total' => $tools->total(),             
                'per_page' => $tools->perPage(),
                'current_page' => $tools->currentPage(),
                'last_page' => $tools->lastPage(),
                'from' => $tools->firstItem(),
                'to' => $tools->lastItem()
            ],
            'data' => $tools
        ];
        return response()->json($response);
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
        $this->validate($request, [
            'name' => 'required|unique:tools',
            'description' => 'required',
            'type_id' => 'required|exists:types,id',
            'area_id' => 'required|exists:areas,id',
            'responsible_id' => 'required|exists:responsibles,id'
        ]);

        $tool = \App\Tool::create($request->all());

        return response()->json(['status' => 1, 'tool' => $tool]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tools',
            'description' => 'required',
            'type_id' => 'required|exists:types,id',
            'area_id' => 'required|exists:areas,id',
            'responsible_id' => 'required|exists:responsibles,id'
        ]);

        if($validator->fails()){
            return response()->json(['status' => 0, 'request' => $request->all(), 'uri' => $request->path(), 'url' => $request->url()]);
        }
        else{
            $tool = \App\Tool::find($id)->update($request->all());
            return response()->json(['status' => 1, 'tool' => $tool]);
        }
    }

    public function destroy($id)
    {
        Tool::find($id)->delete();
        return response()->json(['status' => 1]);
    }

}