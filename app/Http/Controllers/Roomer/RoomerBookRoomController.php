<?php

namespace Rumi\Http\Controllers\Roomer;

use Illuminate\Http\Request;
use Validator;
use Rumi\Models\NewRoomBookOrder; 
use Auth;
use Carbon\Carbon;
use Session;
use Rumi\Http\Controllers\Controller;

class RoomerBookRoomController extends Controller
{
    public function orderRoom(Request $request){
    	$validate = Validator::make($request->all(),	 [
    		'notes' => 'max:500|string',
    	]);

    	$roomerId = Auth::guard('roomer')->user()->id;
    	$hostelId = $request->hid;
    	$now = Carbon::now();

    	$newRoomOrder = new NewRoomBookOrder;

    	$newRoomOrder->roomer_id = $roomerId;
    	$newRoomOrder->order_notes = $request->notes;
    	$newRoomOrder->hostel_id = $hostelId;
    	$newRoomOrder->book_date = $now;

    	$newRoomOrder->save();
    	return response()->json([
			'status' => 'success',
			'message' => 'Room successfully ordered',
		]);



    }

    
}
