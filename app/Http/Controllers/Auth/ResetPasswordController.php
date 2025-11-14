<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @return string
     */
    protected function redirectTo()
    {
        session()->flash('status', 'Your password has been successfully reset.');
        return '/'; // Redirect all users to the landing page
    }
}
