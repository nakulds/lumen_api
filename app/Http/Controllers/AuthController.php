<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(RegisterRequest $request)
    {
        //validate incoming request 
        $request->validate();

        try 
        {
            $data = $request->all();
            $data['password'] = app('hash')->make($data['password']);

            $register = User::create($data);
            $register->save();
            return response()->json( [
                        'entity' => 'users', 
                        'action' => 'create', 
                        'result' => 'success'
            ], 201);

        } 
        catch (\Exception $e) 
        {
            return response()->json( [
                       'entity' => 'users', 
                       'action' => 'create', 
                       'result' => 'failed',
                       'msg' => $e->getMessage()
            ], 409);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */  
    public function login(LoginRequest $request)
    {
        //validate incoming request 
        $request->validate();

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {           
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get todo list by user.
     *
     * @param  Request  $request
     * @return Response
     */     
    public function todoList(Request $request)
    {
        $todo = Auth::user()->todos();
        if ($request->type == 'day' && !empty($request->filter)) {
            $todo = $todo->whereDate('todo_date', date('Y-m-d', strtotime($request->filter)));
        } elseif ($request->type == 'month' && !empty($request->filter)) {
            $todo = $todo->whereMonth('todo_date', date('m', strtotime($request->filter)));
        }
        $todo = $todo->get();
        return response()->json(['status' => 'success','result' => $todo]);
    }

    /**
     * Get todo list by category.
     *
     * @param  Request  $request
     * @return Response
     */     
    public function todoListByCategory(Request $request, $id)
    {
        $todo = Auth::user()->todos()->where('category_id', $id)->get();
        return response()->json(['status' => 'success','result' => $todo]);
    }

    /**
     * Get todo list by status.
     *
     * @param  Request  $request
     * @return Response
     */     
    public function todoListByStatus(Request $request, $status)
    {
        $todo = Auth::user()->todos()->where('status', $status)->get();
        return response()->json(['status' => 'success','result' => $todo]);
    }
}
