<?php

namespace Rumi\Http\Controllers\Leaser;

use Illuminate\Http\Request;
use Rumi\Models\Leaser;
use Rumi\Models\LeaserProfile;
use Auth;
use DB;
use Validator;
use Rumi\Http\Controllers\Controller;

class LeaserProfileController extends Controller
{
  
    /**
     * Display a listing of the current authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $userId = Auth::guard('leaser')->user()->id;
      
      $userProfile = Leaser::find($userId);
      $allProfile = $userProfile->leaserprofile;
      
      return response()->json([
        'status' => 'success',
        'response' => [
          'userProfile' => $userProfile,
        ] 
      ]);


    }


    /**
     * update the current authenticated user's profile.
     * @param Response
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $validate = Validator::make($request->all(), [
          'first_name' => 'min:5|max:255',
          'last_name' => 'min:5|max:255',
          'about_me' => 'min:6|max:255',
        ]);


        if($validate->fails()){
          return response()->json(['error' => $validate->errors()]);
        }

        $leaserId = Auth::guard('leaser')->user()->id;
        $leaser = LeaserProfile::find($leaserId);
        

        $leaser->first_name = $request->input('first_name');
        $leaser->last_name = $request->input('last_name');
        $leaser->about_me = $request->input('about_me');

        $leaser->save();
        
        return response()->json([
          'status' => 'success',
          'message' => 'Profile Updated Successfully',
          'response' => $leaser,
        ]);

}
}