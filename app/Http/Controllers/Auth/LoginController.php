<?php

namespace App\Http\Controllers\Auth;

use App\Classes;
use App\Http\Controllers\Controller;
use App\Social;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        if(Auth::user()->hasRole('ST')) {
//            $redirectTo = '/frontend/student';
//
//        } else if(Auth::user()->hasRole('TC')) {
//            $redirectTo = 'frontend/teacher';
//
//        } else if(Auth::user()->hasRole('AD')) {
//
//            $redirectTo = '/backend/manager-users';
//        }

        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $social = Social::where('provider_user_id', $user->id)->where('provider', 'facebook')->first();

        if ($social) {
            $u = User::where(['email' => $user->email])->first();
            Auth::login($u);
            if ($u->type == 0) {
                return redirect()->route('get.setup.roles');
            } else {
                if ( Auth::user()->hasRole('ST')) {
                    return redirect()->route('frontend.dashboard.student.index');
                }

                if ( Auth::user()->hasRole('AD')) {
                    return redirect()->route('backend.manager.users.index');
                }

                if ( Auth::user()->hasRole('AT')) {
                    return redirect()->route('backend.manager.author.index');
                }
            }
        } else {
            $temp = new Social();
            $temp->provider_user_id = $user->id;
            $temp->provider = 'facebook';

            $u = User::where(['email' => $user->email])->first();
            if (!$u) {
                $u = User::create([
                    'user_name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'type' => 0
                ]);
            }
            $temp->user_id = $u->id;

            $temp->save();

            Auth::login($u);
            return redirect()->route('get.setup.roles');
        }
    }

}
