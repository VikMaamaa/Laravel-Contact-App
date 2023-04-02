<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function edit(){

        return view('settings.profile', [
            'user' => auth()->user()
        ]);
    }

    public function update(ProfileUpdateRequest $request) {
       $profileData = $request->handleRequest();

        $request->user()->update($profileData);

        // $request->user()->update($request->validated());

        return back()->with('message', 'Profile has been updated successfully');
    }

    // public function handleRequest($request){
    //     $profileData = $request->validated();
    //     $profile  = $request->user();
    //     // dump($request->file('profile_picture'));

    //     if($request->hasFile('profile_picture')){
    //         $picture  = $request->profile_picture;

    //         // dump($picture->getClientOriginalName());
    //         // dump($picture->getClientOriginalName());
    //         // dump($picture->getClientSize());
    //         // dump($picture->getClientMimeType());

    //         $fileName = "profile-picture-{$profile->id}." . $picture->getClientOriginalExtension();

    //         $picture->move(public_path('upload'), $fileName);
    //         $profileData['profile_picture'] = $fileName;
    //     }

    //     return $profileData;
    // }


}
