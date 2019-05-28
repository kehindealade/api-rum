<?php

namespace Rumi\Http\Controllers\Roomer;


use Illuminate\Http\Request;
use Rumi\Models\Roomer;
use Rumi\Models\RoomerProfile;
use Auth;
use Session;
use Validator;
use Rumi\Http\Controllers\Controller;

class RoomerProfileController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::guard('roomer')->user()->id;
      
        $userProfile = Roomer::find($userId);
        $allProfile = $userProfile->roomerprofile;
        
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

        $roomerId = Auth::guard('roomer')->user()->id;
        $roomer = RoomerProfile::find($roomerId);
        

        $roomer->first_name = $request->input('first_name');
        $roomer->last_name = $request->input('last_name');
        $roomer->about_me = $request->input('about_me');

        $roomer->save();
        
        return response()->json([
          'status' => 'success',
          'message' => 'Profile Updated Successfully',
          'response' => $roomer,
        ]);

}

   
}
