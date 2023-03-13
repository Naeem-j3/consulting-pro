<?php

namespace App\Http\Controllers;


use App\Http\Resources\ExpertsTimeResource;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\DaysResource;
use App\Models\Day;
use App\Models\Expert;
use App\Models\Reservation;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
   public function reserve(Request $request){

    $user =Auth::guard('user-api')
     ->user()->id;
     $res =Reservation::query()->where('expert_id', $request->expert_id)->where(
      'day_id',$request->day_id)->where( 'A_date',$request->A_date)->first();
     
if ( $res == null  ){
  $rev =Reservation::query()->create([
    'expert_id'=> $request->expert_id,
    'user_id'=>$user,
    'day_id'=>$request->day_id,
    'A_date'=>$request->A_date,
    
  ]);
   return response()->json(['success'=>['expert_name'=>$rev->expert->name,
   'date'=>$rev->A_date,
   'day'=>$rev->day->day_name]], 200);
}

else {
  return response()->json(['message'=>'the appointment is already booked'], 404);

   }}

   public function showDays( Expert $expert)
    {  
         return [
          
           DaysResource::collection($expert->days),
        ];
        
    }

    public function reservedDates(){
        $expert_id =Auth::guard('expert-api')
        ->user()->id;
        $res =Reservation::query()->where('expert_id', $expert_id)->get();
  
  if ($res){
    return response()->json(['errors' => 'there are no appointment '],401);
   }
  else {
    // $r =Reservation::query()->get();
  
    return response()->json(ReservationResource::collection ($res), 200);
   }
  
   
  
  
  }}
