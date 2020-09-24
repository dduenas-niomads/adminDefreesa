<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ApiAuthController;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function passwordEmail(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|string"
        ]);
        $status = ApiAuthController::passwordResetLink($credentials);
        $email = $credentials['email'];
        $message = "Le hemos enviado un enlace de verificación a ". $email . ". para que restablezca su contraseña.";
        if (!$status) {
            $message = "El usuario " . $email . " no existe. Por favor, intente nuevamente.";
        }
        return view('auth.passwordresult', compact('email', 'message', 'status'));
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
