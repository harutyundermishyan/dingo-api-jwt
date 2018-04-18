<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     *middleware jwt auth
     */
    public function __construct(){
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::with('models.products', 'category')->get();

        return response()->json(["brands" => $brands]);
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
            'category_id' => 'required|integer',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $brand = Brand::create([
            'name' => $request->name,
            'category_id' => $request->name,
        ]);

        if ($brand) {
            return response()->json([
                'status' => 'success',
                'message' => 'Brand created successfully'
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
        $brand = Brand::with('models.products', 'category')->findOrFail($id);

        return response()->json(["brand" => $brand]);
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
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $rules = [
            'category_id' => 'integer',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $brand->fill($data);
        $update = $brand->save();

        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'Brand updated successfully'
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
        $delete = Brand::destroy($id);

        if ($delete) {
            return response()->json([
                'status' => 'success',
                'message' => 'Brand deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 403);
        }
    }
}
