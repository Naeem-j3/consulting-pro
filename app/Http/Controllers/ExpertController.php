<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpertsResource;
use App\Models\Expert;
use App\Models\Consultant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ExpertController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $experts =Expert::all();
       return ExpertsResource::collection($experts); 
    }

  
    public function show( Expert $expert)
    {  
      
      
         return new ExpertsResource($expert);
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
      $expert=Auth::guard('expert-api')->user();
        $input =$request->all();
    if($request->file('image_path')){
        $newfile=time().$request->file('image_path')->getClientOriginalName();
        $file_path=$request->file('image_path')->storeAs('images',$newfile,'naeem');
        $input['image_path'] = $file_path;
    }
      $expert->update([
       'name'=>($request->name) ?$request->name :$expert->name,
       'email'=>($request->email) ?$request->email :$expert->email,
       'consultant_id'=>($request->consultant_id) ?$request->consultant_id :$expert->consultant_id,
       'image_path'=>($request->image_path) ?$input['image_path'] :$expert->image_path,
       'adress'=>($request->adress) ?$request->adress :$expert->adress,
       'phone'=>($request->phone) ?$request->phone :$expert->phone,
      ]);
return new ExpertsResource ($expert);
    }


    public function show_experts_has_consulat($id){

  $expertQuery = Expert::query()
      ->where('consultant_id',$id)->get();
      return   ExpertsResource::collection ($expertQuery);
    }
    public function search_expert_name(){
      $text=request('name');
      $expert['expert']=Expert::where('name','like','%'.$text.'%')->get();
      $expert['cons']=Consultant::where('name','like','%'.$text.'%')->get();
      return response()->json($expert ,200 );

    }
    public function showProfile(){
      $expert=Auth::guard('expert-api')->user();
      return $this->show($expert);
    }

}
