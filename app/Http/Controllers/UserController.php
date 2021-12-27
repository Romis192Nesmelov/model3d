<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Settings;

class UserController extends StaticController
{
//    use HelperTrait;
//
//    protected $directionsFields = [];
//    protected $ignoreFields = [];
//    protected $executorsIds = [];
//
//    public function __construct()
//    {
//        $this->middleware('auth');
//        $this->middleware('auth.creds');
//    }
//
//    public function profile(Request $request)
//    {
//        return $this->showView('profile');
//    }
//
//    public function editProfile(Request $request)
//    {
//        $validationArr = [
//            'email' => $this->validationEmail . ',' . Auth::id(),
//            'phone' => $this->validationPhone . '|unique:users,email,' . Auth::id(),
//            'name' => $this->validationCharField,
//            'avatar' => $this->validationImage
//        ];
//
//        $userBoolFields = ['send_mail'];
//        $ignoreFields = ['active','avatar','password','password_confirmation'];
//
//        $fieldsUser = $this->processingFields($request, $userBoolFields, $ignoreFields);
//
//        if ($request->has('password') && $request->input('password')) {
//            $fieldsUser['password'] = bcrypt($request->input('password'));
//            $validationArr['old_password'] = 'required|min:4|max:50';
//            $validationArr['password'] = $this->validationPassword;
//        }
//
//        $this->validate($request, $validationArr);
//
//        $user = User::find(Auth::id());
//        $user->update($fieldsUser);
//
//        if ($request->hasFile('avatar')) {
//            $fieldAvatar = $this->processingImage($request, $user, 'avatar', 'user_avatar'.$user->id, 'images/avatars');
//            $user->update($fieldAvatar);
//        }
//        return redirect('/profile')->with('message', trans('content.save_complete'));
//    }
}
