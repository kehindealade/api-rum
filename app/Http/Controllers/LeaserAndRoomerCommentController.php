<?php

namespace Rumi\Http\Controllers;

use Illuminate\Http\Request;
use Rumi\HostelConversation;
use Auth;
use Validator;
use Rumi\Hostel;

class LeaserAndRoomerCommentController extends Controller
{
   public function showConvos(){

}
   public function sendConvo(Request $request, $hid = null, $rid = null){
      $hostelConvo = new HostelConversation;
      $validate = Validator::make($request->all(), [
         'message' => 'required|min:1|max:255',
      ]);

      if($validate->fails()){
         return response()->json([
            'errors' => $validate->errors(),
         ]);
      }
      
      if(Auth::guard('leaser')->check()){
         $leaserId = Auth::guard('leaser')->user()->id;
         $hostelConvo->leaser_id = $leaserId;
         $hostelConvo->hostel_id = $hid;

         $hostelConvo->message = $request->message;
         $hostelConvo->response_to = $rid;
         $hostelConvo->save();

         return response()->json([
            'status' => 'success',
            'message' => 'Sent Successfully leaser!',
         ]);


      }else if(Auth::guard('roomer')->check()){
         $roomerId = Auth::guard('roomer')->user()->id;
         $hostelConvo->roomer_id = $roomerId;
         $hostel = Hostel::find($hid)->leaser;


         $hostelConvo->hostel_id = $hid;

         $hostelConvo->message = $request->message;
         $hostelConvo->response_to = $hostel->id;
         
         $hostelConvo->save();

         return response()->json([
            'status' => 'success',
            'message' => 'Sent Successfully roomer!',
         ]);
      }

      
   }
   public function getConvo($hid){
      if(Auth::guard('leaser')->check()){
         global $leaserId;
         $leaserId = Auth::guard('leaser')->user()->id;

         $hostelConvo = HostelConversation::where('hostel_id', $hid)->get();

         if(count($hostelConvo) == 0){
            return response()->json(['error' => 'No messages yet']);
         }

         return response()->json([
            'status' => 'success',
            'response' => $hostelConvo,
         ]);

      }else if(Auth::guard('roomer')->check()){
         $roomerId = Auth::guard('roomer')->user()->id;
         $hostelLeaserConvo = HostelConversation::where('hostel_id', $hid)->where('response_to', $roomerId)->get();
         $hostelmyConvo = HostelConversation::where('roomer_id', $roomerId)->where('hostel_id', $hid)->get();

         return response()->json([
            'status' => 'success',
            'response' => [
               'leaser' => $hostelLeaserConvo,
               'roomer' => $hostelmyConvo,
            ]
         ]);


      }
   }

   public function getUnreadMessages(){
      if(Auth::guard('leaser')->check()){
      $leaserId = Auth::guard('leaser')->user()->id;
      $hostelConvo = HostelConversation::where('leaser_id', $leaserId)->where('status', 'unread')->get();

      $no = count($hostelConvo);
      if($no != 0){
      return response()->json([
         'status' => 'success',
         'response' => [
            'unread' => $no
         ]
      ]);
      
      }else{
         return response()->json([
            'error' => 'Sorry you have no notifications yet!',
         ]);
      }
   }else if(Auth::guard('roomer')->check()){
      $roomerId = Auth::guard('roomer')->user()->id;
      $hostelConvo = HostelConversation::where('response_to', $roomerId)->where('status', 'unread')->get();

      $no = count($hostelConvo);
      if($no != 0){
      return response()->json([
         'status' => 'success',
         'response' => [
            'unread' => 'You have ' . $no . ' unread notifications',
         ]
      ]);
      
      }else{
         return response()->json([
            'error' => 'Sorry you have no notifications yet!',
         ]);
      }

      

   }
}

}
