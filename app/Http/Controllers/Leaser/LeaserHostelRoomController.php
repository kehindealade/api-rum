<?php

namespace Rumi\Http\Controllers\Leaser;

use Illuminate\Http\Request;
use Validator;
use Rumi\Models\BookedRoomOrder;
use Carbon\Carbon;
use Rumi\Models\NewRoomBookOrder;
use DB;
use Rumi\Models\RoomNotification;
use Rumi\Http\Controllers\Controller;

class LeaserHostelRoomController extends Controller
{
	public function bookAction(Request $request, $hid, $rid, $bid){
    	if($request->accept){
    		return $this->acceptRoomBookOrder($hid, $rid, $bid);
    	}else if($request->ignore){
    		return $this->ignoreRoomBookOrder($hid, $rid, $bid);
    	}
    }

    public function acceptRoomBookOrder($hid, $rid, $bid){
    	$hostel_id = $hid;
    	$roomer_id = $rid;
    	$book_id = $bid;
    	$now = Carbon::now();

    	$bookedorder = new BookedRoomOrder;
    	$bookedorder->hostel_id = $hostel_id;
    	$bookedorder->roomer_id = $roomer_id;
    	$bookedorder->booked_date = $now;

    	$bookedorder->save();

    	return $this->setStatusFromNewBuyOrder($hostel_id, $roomer_id, $book_id);
    }


    public function setStatusFromNewBuyOrder($hid, $rid, $bid){
    	$newBookOrder = NewRoomBookOrder::find($bid);

    	if(($newBookOrder) != null){
    		$newBookOrder->status = 'acc';
    		$newBookOrder->save();
    	}

		return $this->sendRoomNotification($newBookOrder);
		
    	

	//Send notification to roomer, that he/she can go ahead and pay to us
	//After verifying payment to us, we'll tell the leaser, so he can send the address to the roomer
	//After the roomer checks it, he can tell us to release the money
    }


    public function ignoreRoomBookOrder($hid, $rid, $bid){
    	$newBookOrder = NewRoomBookOrder::find($bid);

    	if(($newBookOrder) != null){
    		$newBookOrder->status = 'ign';
    		$newBookOrder->save();
    	}

			return response()->json([
				'status' => 'success',
				'response' => 'Order Ignored Successfully',
			]);
	}
	
	public function sendRoomNotification($newBookOrder){
		$roomNotification = new RoomNotification;
		$roomNotification->hostel_id = $newBookOrder->hostel_id;
		$roomNotification->roomer_id = $newBookOrder->roomer_id;
	

		$roomNotification->save();

		return response()->json([
			'status' => 'success',
			'response' => 'Order Accepted Successfully and Notication sent!',
		]);
	}
}
