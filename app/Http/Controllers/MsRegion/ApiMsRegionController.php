<?php

namespace App\Http\Controllers\MsRegion;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiMsRegionController extends Controller
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
                $columnName = 'url_image';
                break;
            case 1:
                $columnName = 'name';
                break;
            case 2:
                $columnName = 'description';
            break;
            case 3:
                $columnName = 'flag_active';
                break;
            default:
                $columnName = 'name';
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

    public static function getListSimple()
    {
        $response = ["data" => []];
        if (Auth::user()) {
            $params = [];
            $params['order'] = self::optimizeOrder(isset($params['order']) ? $params['order'] : null);
            $response = self::getListParent($params, 'regions', null);
            if (isset($response['body'])) {
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function getById($id) {
        //
    }

    public static function update($id, $params = [])
    {
        //
    }

    public static function create($params = [])
    {
        //
    }

    public static function delete($id)
    {
        //
    }
}
