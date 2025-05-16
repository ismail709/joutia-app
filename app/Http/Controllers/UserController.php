<?php

namespace App\Http\Controllers;

use App\Enums\AdStatusEnum;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user){
        return view('users.show',['user' => $user, 'ads' => $user->ads()->approved()->paginate(10)]);
    }

    public function myAds(Request $request){
        $status = AdStatusEnum::tryFrom($request->query("status"));
        if($status)
            return view('users.myads',['ads' => auth()->user()->ads()->where('status',$status)->paginate(10)]);
        return view('users.myads',['ads' => auth()->user()->ads()->paginate(10)]);
    }
    
    public function edit(){
        return view('users.profile', ['user' => auth()->user()]);
    }

    public function update(UserRequest $request,User $user){
        $user->update($request->except('profile_img'));

        if($request->hasFile('profile_img')){
            if($user->profile_img_path && Storage::disk('public')->exists($user->profile_img_path))
                Storage::disk('public')->delete($user->profile_img_path);
            $profile_img = $request->file('profile_img')->store('/profile-images','public');
            $user->update(['profile_img_path' => $profile_img]);
        }
        return to_route('profile')->with('success','Your profile has been updated successfully!');
    }
}
