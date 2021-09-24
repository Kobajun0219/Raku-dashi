<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//facebook関係
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Auth;
use Carbon\Carbon;
// use Socialite;

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

    use AuthenticatesUsers {
    logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    //ログイン画面への遷移
    public function showLoginForm(Request $request)
    {
        $com = $request->old();
        return view('auth/login', ['com' => $com]);
    }
    
    
    //ログイン後のページ遷移
    public function redirectPath()
    {
        return '/mypage';

    }
    
    //ログアウト後のページ遷移先
    public function logout(Request $request)
    {
        $this->performLogout($request);
        //redirect先でcom.bladeを表示させるために配列を作成
        $com = ["ログアウトが"];
        return redirect('/login')->withInput($com);
    }
    
    
    
//facebook
    public function FacebookLogin()
   {
       return Socialite::driver('facebook')->redirect();
   }

   public function FacebookLoginCallback()
   {
       $facebook_login = Socialite::driver('facebook')->user();

       $checked_user = User::where(['email' => $facebook_login->getEmail()])->first();

       $now_time = Carbon::now('Asia/Tokyo');

       if($checked_user){
           Auth::login($checked_user);
           return redirect('/home');
       } else {
           $new_user = New User;
           $new_user->name = $facebook_login->getName();
           $new_user->email_verified_at = $now_time;
           $new_user->password = \Hash::make('password');
           $new_user->save();

           Auth::login($new_user);
           return redirect('/home');
       }
   }
    
}
