<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http as HttpClient;
use Illuminate\Support\Facades\Storage;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    const PAGE_NUMBER = 1;
    const PAGE_QUANTITY = 10;

    public static function getListParent($params = [], $uri, $additionalQueryParameters = null)
    {
        $response = ["data" => []];
        $page = self::PAGE_NUMBER;
        $orderColumnName = null;
        $orderDirection = null;
        $searchValue = null;
        if (isset($params['offset'])) {
            $page = ((int)$params['offset'] / self::PAGE_QUANTITY) + $page;
        }
        if (isset($params['order']) && isset($params['order']['opt'])) {
            $orderColumnName = $params['order']['name'];
            $orderDirection = $params['order']['dir'];
        }
        if (isset($params['search']) && isset($params['search']['value'])) {
            $searchValue = $params['search']['value'];
        }
        $request = HttpClient::withHeaders([
            'Authorization' => 'Bearer ' . Auth::user()->access_token
        ])->get(env('API_BUSINESS_URL') . $uri . 
            '?page=' . $page . '&orderBy=' . $orderColumnName . 
            '&orderDir=' . $orderDirection . '&search=' . $searchValue . 
            $additionalQueryParameters);
        if ($request->successful()) {
            $response = $request->json();
        }
        return $response;
    }

    public static function superAdminRole()
    {
        return Auth::user() && Auth::user()->role['code'] === 'super-admin';
    }

    public function uploadImage($fileContents, $path = "defreesa/others")
    {
        $disk = Storage::disk('obs');

        // create a file
        $upload = $disk->put($path, $fileContents);

        // get file url
        if (!is_null($upload)) {
            return env('URL_OBS') . $upload;
        } else {
            return null;
        }
    }
}
