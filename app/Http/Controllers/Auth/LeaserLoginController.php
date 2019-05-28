<?php

namespace Rumi\Http\Controllers\Auth;


use Rumi\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class LeaserLoginController extends Controller
{
  public function __construct()
  {
      $this->middleware('guest:leaser')->except('logout');
  }

    /*
    |--------------------------------------------------------------------------
    | Leaser Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'leaser/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function login()
    {
        return view('leaser.auth.login');
    }

    

    public function loginLeaser(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      // Attempt to log the user in
      if (Auth::guard('leaser')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

        // if successful, then redirect to their intended location
        return redirect()->intended(route('leaser.dashboard'));
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

     public function logout()
    {
        Auth::guard('leaser')->logout();
        return redirect()->route('leaser.auth.login');
    }
}
