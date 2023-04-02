<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable'],
            'bio' => ['nullable'],
            'profile_picture' => ['nullable', 'mimes:png,jpg,bmp']
        ];
    }

    public function handleRequest(){
        $profileData = $this->validated();
        $profile  = $this->user();
        // dump($this->file('profile_picture'));

        if($this->hasFile('profile_picture')){
            $picture  = $this->profile_picture;

            // dump($picture->getClientOriginalName());
            // dump($picture->getClientOriginalName());
            // dump($picture->getClientSize());
            // dump($picture->getClientMimeType());

            $fileName = "profile-picture-{$profile->id}." . $picture->getClientOriginalExtension();

            // $picture->move(public_path('upload'), $fileName);

            // $fileName = Storage::putFileAs('uploads', $picture, "profile-picture-{$profile->id}." . $picture->getClientOriginalExtension());

           $fileName = $picture->storeAs('uploads', $fileName);

            $profileData['profile_picture'] = $fileName;
        }

        return $profileData;
    }
}
