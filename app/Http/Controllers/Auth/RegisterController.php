<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['type']==0){
            return Validator::make($data, [
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'type' => 'required|integer|min:0|max:1',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'userImage' => 'image|nullable|max:5999',
                'college' => 'required|integer',
                'phone_number' => 'required|string|max:11|min:11|unique:users',
                'email' => 'required|email|unique:users',
                'about' => 'string|nullable',
            ]);
        } else {
            return Validator::make($data, [
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'type' => 'required|integer|min:0|max:1',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'userImage' => 'image|nullable|max:5999',
                'college' => 'required|integer',
                'grade_of_college'=>'required|integer',
                'phone_number' => 'required|string|max:11|min:11|unique:users',
                'email' => 'required|email|unique:users',
                'about' => 'string|nullable'
                ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['type'] == 0){
            $member = new \App\Member;
            $member->save();
            $data['id_of'] = $member->id;
        } else if($data['type'] == 1){
            $guest = new \App\Guest;
            $guest->grade_of_college=$data['grade_of_college'];
            $guest->save();
            $data['id_of'] = $guest->id;
        }
        // Handle file upload
        if(array_key_exists('userImage',$data)){
            // Get filename with the ext.
            $fileNameWithExt = $data['userImage']->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext.
            $extension = $data['userImage']->getClientOriginalExtension();
            // FileName To store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $data['userImage']->storeAs('public/usersImages', $fileNameToStore);
        } else {
            $fileNameToStore = 'user.jpg';
        }
        return User::create([
                'username' => $data['username'],
                'type' => $data['type'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'about' => $data['about'],
                'college_id' => $data['college'],
                'photo_url' => $fileNameToStore,
                'id_of' => $data['id_of'],
                'password' => Hash::make($data['password']),
        ]);
    }
}
