<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        // Get user info
        $user = Auth::user();

        // Check if user is still active
        if ($user->is_active == 1) {
            return 'access_denied';
        } else {
            // Active user redirect
            switch ($user->access_id) {
                case 1:
                    return 'office/dashboard';
                    break;
                case 2:
                    return 'store/dashboard';
                    break;
                case 3:
                    return 'store/dashboard';
                    break;
            }
        }
    }
}
