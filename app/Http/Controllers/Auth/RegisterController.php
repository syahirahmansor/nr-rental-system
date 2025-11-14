<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/landlord/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255', 'unique:users',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $value)) {
                        $fail('Only Gmail addresses are allowed.');
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'toc' => ['accepted'], // Ensures the user has checked the Terms and Conditions checkbox
        ], [
            'email.unique' => 'This email is already registered.',
            'toc.accepted' => 'You must agree to the Terms and Conditions.',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 1, 
        ]);

        Landlord::create([
            'user_id' => $user->id,
            'gender' => null,
            'address' => null,
            'phoneno' => null,
        ]);

        return $user;
    }
}
