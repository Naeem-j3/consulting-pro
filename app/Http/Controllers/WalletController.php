<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpertWallteResource;
use App\Http\Resources\UserWallteResource;
use App\Models\Expert;
use App\Models\ExpertWallet;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WalletController extends Controller

{
   public function expertPaidForExpert($expert)
   {  
   $ex=Auth::guard('expert-api')->user();
   $id = $ex->id;

   $cost = 20;
   $expertwallet1 = ExpertWallet::query()
   ->where('expert_id', $id)
   ->first();
   $expertwallet2 = ExpertWallet::query()
   ->where('expert_id',$expert)
   ->first();

   if($expertwallet1->expert_balance >=20){
      $expertwallet1->expert_balance = $expertwallet1->expert_balance-$cost;
   $expertwallet1->save();
   $expertwallet2->expert_balance = $expertwallet2->expert_balance+$cost;
   $expertwallet2->save();

    return response()->json([[
      'expert_id'=> $ex->id,
      'your_balance'=> $ex->expertwallet->expert_balance,
   
    ]], 200);
   }

   else{
      return response()->json([
         'errors' => ['massege' => [' you dont have money']]],400);  
   }
  } 
   

   public function userPaidForExpert($expert)
   {  
   $user=Auth::guard('user-api')->user();
   $id = $user->id;

   $cost = 20;
   $userwallet = UserWallet::query()
   ->where('user_id', $id)
   ->first();
   $expertwallet = ExpertWallet::query()
   ->where('expert_id',$expert)
   ->first();

   if($userwallet->user_balance >=20){
      $userwallet->user_balance = $userwallet->user_balance-$cost;
   $userwallet->save();
   $expertwallet->expert_balance = $expertwallet->expert_balance+$cost;
   $expertwallet->save();

    return response()->json([[
      'user_id'=> $user->id,
      'your_balance'=> $user->userwallet->user_balance,
   
    ]], 200);
   }

   else{
      return response()->json([
         'errors' => ['massege' => ['unfortunately you dont have money']]],400);  
   }
  } 
   }
   
