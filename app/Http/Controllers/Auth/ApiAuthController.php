<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiAuthController extends Controller
{
    /**
     * Create a new api controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public static function passwordResetLink($credentials) {
        $response = false;
        $request = HttpClient::post(env('API_ACL_GUEST') . 'user/forgot-password', [
            'email'     => $credentials['email']
        ]);
        if ($request->successful()) {
            $response = true;
        }
        return $response;
    }

    public static function registerNewUser($credentials) {
        $response = false;
        $request = HttpClient::post(env('API_REGISTER_URL'), [
            'email'             => $credentials['email'],
            'name'              => $credentials['name'],
            'lastname'          => $credentials['lastname'],
            'country'           => $credentials['country'],
            'type_document'     => $credentials['type_document'],
            'document_number'   => $credentials['document_number'],
            'password'          => $credentials['password']
        ]);
        if ($request->successful()) {
            $response = true;
        }
        return $response;
    }
}