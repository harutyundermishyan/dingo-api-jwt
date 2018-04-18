<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/28/2018
 * Time: 4:42 AM
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:6',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => 'Registered successfully'
            ], 200);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 403);
        }
    }
}