<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\HelperTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, GoogleCaptchaTrait, HelperTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
//            'phone' => $this->validationPhone,
            'email' => 'required|string|email|max:255|unique:users',
            'password' => $this->validationPassword,
            'g-recaptcha-response' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
//            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'confirm_token' => $this->randString(),
            'active' => false,
            'type' => 1,
            'send_mail' => 1
        ]);
        return $user;
    }

    public function confirmRegistration($token)
    {
        $user = User::where('confirm_token',$token)->first();
        if ($user) {
            $user->active = 1;
            $user->confirm_token = '';
            $user->save();
            Session::flash('message', trans('auth.register_success'));
            Auth::login($user);
        } else Session::flash('message', trans('auth.register_error'));
        return redirect($this->redirectTo);
    }

//    public function sendConfirmMail()
//    {
//        return view('auth.send_confirm_mail');
//    }
    
    public function confirmUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => 'required|string',
        ]);

        $captchaValidate = $this->validateCaptcha($request);
        if ($captchaValidate) return $captchaValidate;

        $user = User::where('email',$request->input('email'))->first();
        
        if ($user->active) {
            if ($request->ajax()) return response()->json(['errors' => ['email' => [trans('auth.user_already_active')]]], 404);
            else return back()->withInput()->withErrors(['email' => trans('auth.user_already_active')]);
        }
        
        $this->sendMessage($user->email, 'registration', ['token' => $user->confirm_token]);
        
        if ($request->ajax()) return response()->json(['success' => true, 'message' => trans('auth.check_your_mail')]);
        else return redirect($this->redirectTo)->with('message', trans('auth.check_your_mail'));
        
        
    }
}
