<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        $products = Product::with('model.brand.category')->get();

        return response()->json(["products" => $products]);

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
            'model_id' => 'required|integer',
            'image' => 'required',
            'year' => 'required|integer',
            'price' => 'required|integer',
            'rudder' => 'required',
            'transmission_box' => 'required',
            'engine' => 'required',
            'condition' => 'required',
            'state' => 'required',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $product = Product::create([
            'model_id' => $request->model_id,
            'image' => $request->image,
            'year' => $request->year,
            'price' => $request->price,
            'rudder' => $request->rudder,
            'transmission_box' => $request->rudder,
            'engine' => $request->engine,
            'condition' => $request->condition,
            'state' => $request->state,
        ]);

        if ($product) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully'
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
        $product = Product::with('model.brand.category')->findOrFail($id);

        return response()->json(["product" => $product]);
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
        $product = Product::findOrFail($id);
        $data = $request->all();
        $rules = [
            'model_id' => 'integer',
            'year' => 'integer',
            'price' => 'integer'
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $product->fill($data);
        $update = $product->save();

        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully'
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
        $product = Product::destroy($id);

        if ($product) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 403);
        }
    }
}
