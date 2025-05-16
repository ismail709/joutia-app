<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $userRoleId = Role::firstWhere('name',RoleEnum::USER->value)->id;
        
        $user = User::create(array_merge($request->except('profile_img'),['role_id' => $userRoleId]));

        if($request->hasFile('profile_img')){
            $profile_img = $request->file('profile_img')->store('/profile-images','public');
            $user->update(['profile_img_path' => $profile_img]);
        }
        Auth::login($user);
        return to_route('home');
    }

    public function register_form(){
        return view('auth.register');
    }

    public function login(LoginRequest $request){
        if(Auth::attempt($request->only(['email','password']))){
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function login_form(){
        return view('auth.login');
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return to_route('home');
    }

    public function resetPassword(){

    }

    public function changePassword(){
        
    }
}
