<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $categories = Category::with('brands.models.products')->get();

        return response()->json(["categories" => $categories]);
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
            'name' => 'required'
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $category = Category::create([
            'name' => $request->name
        ]);

        if ($category) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully'
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
        $category = Category::with('brands.models.products')->findOrFail($id);

        return response()->json(["category" => $category]);
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
        $category = Category::findOrFail($id);
        $data = $request->all();
        $rules = [
            'name' => 'required'
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $category->fill($data);
        $update = $category->save();

        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully'
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
        $delete = Category::destroy($id);

        if ($delete) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 403);
        }
    }
}
