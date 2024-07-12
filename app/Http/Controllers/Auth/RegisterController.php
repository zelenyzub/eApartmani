<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/administracija-korisnika';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'checkrole']);
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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:USER,ADMIN,SUPERADMIN'],
            'image' => ['image', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
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
        $imagePath = null;

        if (isset($data['avatar'])) {
            // Store the uploaded image in the storage directory
            $imagePath = $data['avatar']->store('public/avatar');

            // Get the file name from the stored path
            $fileName = basename($imagePath);

            // Update the path to match the storage directory
            $imagePath = $fileName;

            // Copy the uploaded image to the public assets directory
            $publicPath = public_path('assets/media/avatars');
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0777, true); // Create the directory if it doesn't exist
            }
            copy(storage_path('app/public/avatar/' . $imagePath), $publicPath . '/' . $fileName);
        }

        $permissions = [
            'canEditReservations' => 0,
            'canDeleteReservations' => 0,
            'canAllowReservations' => 0,
            'canAddReservations' => 0,
        ];

        if ($data['role'] === 'SUPERADMIN') {
            $permissions = [
                'canEditReservations' => 1,
                'canDeleteReservations' => 1,
                'canAllowReservations' => 1,
                'canAddReservations' => 1,
            ];
        }

        return User::create(array_merge([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'image' => $imagePath
        ], $permissions));
    }


}
