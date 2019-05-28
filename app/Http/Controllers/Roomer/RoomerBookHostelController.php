<?php

namespace Rumi\Http\Controllers\Roomer;

use Illuminate\Http\Request;
use Rumi\Http\Controllers\Controller;
use Validator;
use Rumi\Models\NewRoomerHostelOrder;
use Carbon\Carbon;
use Rumi\Models\BookedRoomerHostelOrder;


class RoomerBookHostelController extends Controller
{
    public function order(Request $request){
        $validate = Validator::make($request->all(), [
            'order_notes' => 'string|max:500',
            'owner_id' => 'required|integer',
            'roomer_hostel_id' => 'required|integer',
        ]);

        if($validate->fails()){
            return response()->json(['errors' => $validate->errors()]);
        }

        $roomerId = auth()->guard('roomer')->user()->id;
        $newHostelOrder = new NewRoomerHostelOrder;
        $newHostelOrder->owner_id = $request->owner_id;
        $newHostelOrder->roomer_hostel_id = $request->roomer_hostel_id;
        $newHostelOrder->roomer_id = $roomerId;
        $newHostelOrder->order_notes = $request->order_notes;
        $newHostelOrder->book_date = Carbon::now();

        $newHostelOrder->save();

        return response()->json([
            'status' => 'success',
            'message' => 'You have successfully booked for the room',
        ]);

    }

    public function showAllOrders(){
        $roomerId = auth()->guard('roomer')->user()->id;

        $newHostels = NewRoomerHostelOrder::where('owner_id', $roomerId)->get();

        return response()->json([
            'status' => 'success',
            'response' => $newHostels,
        ]);
    }

    public function showAllUndecidedOrders(){
        $roomerId = auth()->guard('roomer')->user()->id;

        $newHostels = NewRoomerHostelOrder::where('owner_id', $roomerId)->where('status', 'udc')->get();

        return response()->json([
            'status' => 'success',
            'response' => $newHostels,
        ]);
    }


    public function bookAction(Request $request){
        //oid, rhid, nid

        if(($request->accept) == NULL && ($request->ignore) == NULL){
            return response()->json([
                'status' => 'failure',
                'message' => 'You must either accept or ignore',
            ]);
        }

        if(($request->accept) == 1){
            return $this->acceptOrder($request);
        }else if(($request->ignore) == 1){
            return $this->ignoreOrder($request);
        }
    }


    public function acceptOrder($request){
        $ownerId = $request->oid;
        $roomerId = auth()->guard('roomer')->user()->id;
        $rhid = $request->rhid;

        $bookedOrder = new BookedRoomerHostelOrder;
        $bookedOrder->owner_id = $ownerId;
        $bookedOrder->roomer_id = $roomerId;
        $bookedOrder->roomer_hostel_id = $rhid;

        $bookedOrder->save();

        return $this->setStatusToAccepted($request);

    }


    public function setStatusToAccepted($request){
        $nid = $request->nid;

        $nrhid = NewRoomerHostelOrder::find($nid);
        $nrhid->status = 'acc';

        $nrhid->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully accepted',
        ]);

    }


    public function ignoreOrder($request){
        $nid = $request->nid;

        $nrhid = NewRoomerHostelOrder::find($nid);
        $nrhid->status = 'ign';

        $nrhid->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Ignored successfully',
        ]);
    }
}
