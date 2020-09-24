<?php

namespace App\Http\Controllers\Order;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiOrderController extends Controller
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
                $columnName = 'created_at';
                break;
            case 1:
                $columnName = 'correlative';
                break;
            case 2:
                $columnName = 'reference';
                break;
            case 3:
                $columnName = 'status_code';
                break;
            default:
                $columnName = 'created_at';
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
            $response = self::getListParent($params, Auth::user()->role['code'] . '/orders');
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
