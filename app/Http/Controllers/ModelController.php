<?php

namespace App\Http\Controllers;

use App\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModelController extends Controller
{
    /**
     *middleware jwt auth
     */
    public function __construct(){
        $this->middleware(
            'jwt.auth',
            ['except' => ['index', 'show']]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Model::with('products', 'brand.category')->get();

        return response()->json(["models" => $models]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'brand_id' => 'required|integer',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $model = Model::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
        ]);

        if ($model) {
            return response()->json([
                'status' => 'success',
                'message' => 'Model created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Model::with('products', 'brand.category')->findOrFail($id);

        return response()->json(["model" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Model::findOrFail($id);
        $data = $request->all();
        $rules = [
            'brand_id' => 'integer'
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $model->fill($data);
        $update = $model->save();

        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'Model updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::destroy($id);

        if ($model) {
            return response()->json([
                'status' => 'success',
                'message' => 'Model deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 403);
        }
    }
}
