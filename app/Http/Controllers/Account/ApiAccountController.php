<?php

namespace App\Http\Controllers\Account;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiAccountController extends Controller
{
    /**
     * Create a new api controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public static function getMyAccount() {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->get(env('API_BUSINESS_URL') . 'user');
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function updateMyAccount($params = [])
    {
        $response = null;
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->patch(env('API_BUSINESS_URL') . 'user/update', [
                'name' => isset($params['inputName']) ? $params['inputName'] : null,
                'lastname' => isset($params['inputLastname']) ? $params['inputLastname'] : null,
                'type_document' => isset($params['inputTypeDocument']) ? $params['inputTypeDocument'] : null,
                'document_number' => isset($params['inputDocumentNumber']) ? $params['inputDocumentNumber'] : null,
                'password' => isset($params['inputPassword']) ? $params['inputPassword'] : null,
                'null_validation' => true
            ]);
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function logoutAll()
    {
        $response = null;
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->delete(env('API_BUSINESS_URL') . 'user/logout-all');
            if ($request->successful()) {
                $response = $request->json();
            }
        }
        return $response;
    }
}
