<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiClientController extends Controller
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
                $columnName = 'user_name';
                break;
            case 1:
                $columnName = 'user_lastname';
                break;
            case 2:
                $columnName = 'user_document_number';
                break;
            case 3:
                $columnName = 'last_purchase';
                break;
            case 4:
                $columnName = 'total_purchases';
            break;
            case 5:
                $columnName = 'flag_active';
                break;
            default:
                $columnName = 'user_name';
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
            $response = self::getListParent($params, Auth::user()->role['code'] . '/clients');
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
            ])->get(env('API_BUSINESS_URL') . 'warehouses/' . $id);
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }
}
