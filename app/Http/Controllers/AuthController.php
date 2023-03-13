<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\HasApiTokens;
use token;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rules\Password;
class AuthController extends Controller
{
   public function userRegister (Request $request) :JsonResponse{
    
    $validator = Validator::make($request->all(),[
        'name' =>['required' , 'max:55','string'],
        'email' =>['required' , 'email','unique:users'],//
        'password'=>['required', password::min(8) ]
    ]);
    if($validator->fails()){
        return response()->json('error validation', 400);
    }
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::query()->create($input);
    $accessToken = $user->createToken('MyApp' , ['user'])->accessToken;
    DB::table('user_wallets')->insert([
        'user_id' => $user['id'],
       'user_balance' => 150,

        ]);
return response()->json([
    'user' =>$user,
    'accessToken' =>$accessToken,
],200); 
   }
    public function userLogin (Request $request) :JsonResponse {

        $validator=validator::make( $request->all(),[
        'email' =>['required' , 'email'],
        'password'=>['required'],
    ]);
    if($validator->fails()){
        return response()->json('error validation', 400);
    }
$credentials = request(['email','password']);
    if(auth()->guard('user')->attempt($request->only('email','password'))){
config(['auth.guards.api.provider' =>'user']);
$user = User::query()->find(auth()->guard('user')->user()['id']);
$success = $user;
$success['token'] = $user->createToken('MyApp',['user'])->accessToken;
return response()->json($success,200); }
else {
     return response()->json(['errors' =>['Unauthorized']],400);}
       
    } 
    public function userLogout(Request $request) :JsonResponse{
         /**@var \App\Models\MyUserModel */
      $user = Auth::guard('user-api');
      $user->user()->token()->revoke();
        return response()->json(['seccess' => 'You Have Successfully Logout'],200);
        }

        public function expertRegister (Request $request) :JsonResponse{
    
            $validator = Validator::make($request->all(),[
                'name' =>['required' , 'max:55','string'],
                'email' =>['required' , 'email','unique:experts'],//
                'password'=>['required', password::min(8) ],
                'details'=> ['required'],
                'adress'=> ['required'],
                'phone'=> ['required'],
                'consultant_id'=> ['required'],
            ]);
            if($validator->fails()){
                return response()->json('error validation', 400);
            }
             $input = $request->all();
            $input['password'] = bcrypt($input['password']);
             if($request->file('image_path')){
                $newfile=time().$request->file('image_path')->getClientOriginalName();
                $file_path=$request->file('image_path')->storeAs('images',$newfile,'naeem');
                $input['image_path'] = $file_path;
            }
            $expert = Expert::query()->create($input);
            $expert->save();
            $expert->days()->attach($request->days);
            $accessToken = $expert->createToken('MyApp' , ['expert'])->accessToken;
            DB::table('expert_wallets')->insert([
            'expert_id' => $expert['id'],
           'expert_balance' => 150,

            ]);
        return response()->json([
            'expert' =>$expert,
            'accessToken' =>$accessToken,
        ],200); 
           }
            public function expertLogin (Request $request) :JsonResponse {
        
                $validator=validator::make( $request->all(),[
                    'email' =>['required' , 'email'],
                    'password'=>['required'],
                ]);
                if($validator->fails()){
                    return response()->json('error validation', 400);
                }
        $credentials = request(['email','password']);
            if(auth()->guard('expert')->attempt($request->only('email','password'))){
        config(['auth.guards.api.provider' =>'expert']);
        $expert = Expert::query()->find(auth()->guard('expert')->user()['id']);
        $success = $expert;
        $success['token'] = $expert->createToken('MyApp',['expert'])->accessToken;
        return response()->json($success,200); }
        else {
            return response()->json([
            
                'message'  => 'could not sign you in with those credentials'
                
            ],400);}
                   
                } 
                public function expertLogout(Request $request) :JsonResponse{
                    /**@var \App\Models\MyUserModel */
             $user =Auth::guard('expert-api');
            $user->user()->token()->revoke();  
            return response()->json(['seccess' => 'You Have Successfully Logout'],200);
            }
    
    
                }