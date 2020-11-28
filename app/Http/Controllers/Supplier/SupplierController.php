<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Supplier\ApiSupplierController;
use App\Http\Controllers\Category\ApiCategoryController;
use Auth;
use Carbon\Carbon;

class SupplierController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $categories = ApiCategoryController::getListSimple();
        $view = view('suppliers.suppliers', compact('categories'));
        return $view;
    }

    public function updateForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        if (isset($params['file'])) {
            $params['url_image'] = $this->uploadImage($params['file'], "defreesa/suppliers");
        }
        $categories = ApiCategoryController::getListSimple();
        $result = ApiSupplierController::update(isset($params['id']) ? (int)$params['id'] : null, $params);
        $view = view('suppliers.suppliers', compact('notification', 'categories', 'result'));
        return $view;
    }

    public function deleteForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $categories = ApiCategoryController::getListSimple();
        $result = ApiSupplierController::delete(isset($params['id']) ? (int)$params['id'] : null);
        $view = view('suppliers.suppliers', compact('notification', 'categories', 'result'));
        return $view;
    }

    public function createForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $carrousel = [];
        if (isset($params['file'])) {
            $params['url_image'] = $this->uploadImage($params['file'], "defreesa/suppliers");
        }
        if (isset($params['carrousel1'])) {
            array_push($carrousel,$this->uploadImage($params['carrousel1'], "defreesa/suppliers"));
        }
        if (isset($params['carrousel2'])) {
            array_push($carrousel,$this->uploadImage($params['carrousel2'], "defreesa/suppliers"));
        }
        if (isset($params['carrousel3'])) {
            array_push($carrousel,$this->uploadImage($params['carrousel3'], "defreesa/suppliers"));
        }
        if (count($carrousel) !== 0) {
            $params['image_carrousel'] = $carrousel;
        }
        $categories = ApiCategoryController::getListSimple();
        $result = ApiSupplierController::create($params);
        $view = view('suppliers.suppliers', compact('notification', 'categories', 'result'));
        return $view;
    }

    public function uploadFile(Request $request)
    {
        request()->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($files = $request->file('file')) {

            $file->save();

            return Response()->json(Response::HTTP_OK);
 
        }
 
    }
}
