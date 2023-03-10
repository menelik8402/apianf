<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','index','updated','destroy']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],200);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:50|min:3',
            'surname'=> 'required|string|max:50|min:3',
            'email' => 'required|string|unique:users|email|max:255',
            'password'=> 'required|string|min:6',
            'gender' => 'required|string',
            'birthday'=>'required|string|date_format:Y-m-d',
            'age' => 'required|number',
        ],[
            'name.required' => 'The name is required',
            'email.unique' => 'User with this email exist',
            'birthday.date_format' => 'Check date format (Y-m-d)'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);

        }
        $user = User::create(array_merge(
            $validator->validate(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json($user, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
    }

    public function index(){
        $users = User::all();

        return response()->json(['users' => $users], 200);

    }
    public function update(Request $request){

        $user = User::FindOrFail($request->id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->age=$request->age;
        $user->gender = $request->sex;
        $user->email=$request->email;

        return response()->json(['status' => 'User updated'], 200);

    }

    public function destroy(Request $request){
        $user = User::destroy($request->id);

        return response()->json(['status' => 'User destroyed'], 200);
    }
   
}
