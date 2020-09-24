<?php

namespace App\Http\Controllers\License;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiLicenseController extends Controller
{
    /**
     * Create a new api controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    private static function postRequest($url, $postData, $token) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$token,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $postData
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function getLicenses() {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->get(env('API_BUSINESS_URL') . 'licenses');
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function getLicenseByType($type) {
        $response = null;
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->get(env('API_BUSINESS_URL') . 'licenses/by-type/' . $type);
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function generateToken() {
        // CURL REQUEST
        $response = null;
        $request = HttpClient::withHeaders([
            "Accept" => "*/*",
            "Authorization" => "Basic " . base64_encode(
                config('visa.' . env('VISA_ENVIRONMENT') . '.VISA_USER') . ":" . 
                config('visa.' . env('VISA_ENVIRONMENT') . '.VISA_PWD'))
        ])->post(config('visa.' . env('VISA_ENVIRONMENT') . '.VISA_URL_SECURITY'));
        if ($request->successful()) {
            $response = $request->body();
        }
        return $response;
    }

    public static function generatePurchaseNumber() {
        $response = null;
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->get(env('API_BUSINESS_URL') . 'purchases/next-number');
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function generateSesion($amount, $token, $maxAmount) {
        $session = array(
            'amount' => $amount,
            'antifraud' => array(
                'clientIp' => $_SERVER['REMOTE_ADDR'],
                'merchantDefineData' => array(
                    'MDD1' => config('visa.' . env('VISA_ENVIRONMENT') . '.VISA_MERCHANT_ID'),
                    'MDD2' => "Integraciones VisaNet",
                    'MDD3' => 'web'
                ),
            ),
            'channel' => 'web',
            'recurrenceMaxAmount' => $maxAmount
        );
        $json = json_encode($session);
        $response = json_decode(self::postRequest(
            config('visa.' . env('VISA_ENVIRONMENT') . '.VISA_URL_SESSION'), $json, $token));
        return $response->sessionKey;
    }

    public static function generateAuthorization($amount, $purchaseNumber, $transactionToken, $token, $userId = null) {
        $data = array(
            'antifraud' => null,
            'captureType' => 'manual',
            'channel' => 'web',
            'countable' => true,
            'cardHolder' => [
                'documentNumber' => str_pad($userId, 15, "0", STR_PAD_LEFT),
                'documentType' => '2'
            ],
            'order' => array(
                'amount' => $amount,
                'currency' => env('APP_MAIN_CURRENCY'),
                'purchaseNumber' => $purchaseNumber,
                'tokenId' => $transactionToken
            ),
            'recurrence' => null,
            'sponsored' => null
        );
        $json = json_encode($data);
        $session = json_decode(self::postRequest(
            config('visa.' . env('VISA_ENVIRONMENT') . '.VISA_URL_AUTHORIZATION'), $json, $token));
        return $session;
    }

    public function generateAuthorizationWS(Request $request) {
        $response = response([], 403);
        if (Auth::user()) {
            $token = $request->get('token');
            if (!is_null($token)) {
                $visaResponse = self::generateAuthorization($request->get('amount'), 
                    $request->get('purchaseNumber'), $request->get('transactionToken'), 
                    $token, Auth::user()->id);
                $visaResponse->free = false;
            } else {
                $visaResponse = new \stdClass();
                $visaResponse->free = true;
            }
            if ($visaResponse) {
                $visaResponse->clientNames = Auth::user()->name . ' ' . Auth::user()->lastname;
                $visaResponse->licenseType = $request->get('type');
                $visaResponse->purchaseNumber = $request->get('purchaseNumber');
                $visaResponse->dateTimePurchase = date("Y-m-d H:i:s");
                $visaResponse->failed = false;
                if (isset($visaResponse->errorCode)) {
                    $visaResponse->failed = true;
                }
                $request = HttpClient::withHeaders([
                    'Authorization' => 'Bearer ' . Auth::user()->access_token
                ])->post(env('API_BUSINESS_URL') . 'purchases', [
                    'visaResponse'    => json_encode($visaResponse),
                    'licenseType'     => $request->get('type'),
                    'purchaseNumber'  => $request->get('purchaseNumber'),
                    'failed'          => $visaResponse->failed
                ]);
                if ($request->successful() && !$visaResponse->failed) {
                    $response = response((array)$visaResponse, 200);
                } else {
                    $visaResponse->errorCode = 400;
                    $visaResponse->errorMessage = "Transaction error.";
                    $response = response((array)$visaResponse, 400);
                }
            } else {
                $visaResponse->errorCode = 500;
                $visaResponse->errorMessage = "Operation error.";
                $response = response((array)$visaResponse, 500);
            }
        }
        
        return $response;
    }
}
