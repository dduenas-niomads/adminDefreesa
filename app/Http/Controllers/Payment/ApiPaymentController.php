<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiPaymentController extends Controller
{
    /**
     * Create a new api controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    private static function getOrderColumnName($order = 0) {
        $columnName = null;
        switch ($order) {
            case 0:
                $columnName = 'bs_suppliers_id';
                break;
            case 1:
                $columnName = 'total';
                break;
            case 2:
                $columnName = 'status';
                break;
            case 3:
                $columnName = 'active';
                break;
            default:
                $columnName = 'total';
                break;
        }
        return $columnName;
    }

    private static function optimizeOrder($order) {
        if (!is_null($order) && isset($order[0])) {
            $order = [
                "name" => self::getOrderColumnName($order[0]['column']),
                "dir" => $order[0]['dir'],
                "opt" => true
            ];
        }
        return $order;
    }

    public static function getList(Request $request) {
        $response = ["data" => []];
        if (Auth::user()) {
            $params = $request->all();
            $params['order'] = self::optimizeOrder(isset($params['order']) ? $params['order'] : null);
            $response = self::getListParent($params, 'payments', '&all=1');
            if (isset($response['body'])) {
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function getById($id) {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->get(env('API_BUSINESS_URL') . 'payments/' . $id);
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    
    public static function update($id, $params = [])
    {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->patch(env('API_BUSINESS_URL') . 'payments/' . $id, $params);
            if ($request->successful()) {
                $response = $request->json();
                $response['result'] = "success";
            } else {
                $response = $request->json();
                $response['result'] = "danger";
            }
        }
        return $response;
    }

    public static function create($params = [])
    {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->post(env('API_BUSINESS_URL') . 'payments', $params);
            if ($request->successful()) {
                $response = $request->json();
                $response['result'] = "success";
            } else {
                $response = $request->json();
                $response['result'] = "danger";
            }
        }
        return $response;
    }

    public static function delete($id)
    {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->delete(env('API_BUSINESS_URL') . 'payments/' . $id);
            if ($request->successful()) {
                $response = $request->json();
                $response['result'] = "success";
            } else {
                $response = $request->json();
                $response['result'] = "danger";
            }
        }
        return $response;
    }
}
