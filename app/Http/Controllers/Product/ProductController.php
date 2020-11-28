<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Product\ApiProductController;
use App\Http\Controllers\Supplier\ApiSupplierController;
use App\Http\Controllers\MsProductCategory\ApiMsProductCategoryController;
use Auth;
use Carbon\Carbon;

class ProductController extends Controller
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
        $categories = ApiMsProductCategoryController::getListSimple();
        $suppliers = ApiSupplierController::getListSimple();
        $view = view('products.products', compact('categories', 'suppliers'));
        return $view;
    }

    public function updateForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $categories = ApiMsProductCategoryController::getListSimple();
        $suppliers = ApiSupplierController::getListSimple();
        $result = ApiProductController::update(isset($params['id']) ? (int)$params['id'] : null, $params);
        $view = view('products.products', compact('notification', 'result', 'categories', 'suppliers'));
        return $view;
    }

    public function deleteForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $categories = ApiMsProductCategoryController::getListSimple();
        $suppliers = ApiSupplierController::getListSimple();
        $result = ApiProductController::delete(isset($params['id']) ? (int)$params['id'] : null);
        $view = view('products.products', compact('notification', 'result', 'categories', 'suppliers'));
        return $view;
    }

    public function createForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $categories = ApiMsProductCategoryController::getListSimple();
        $suppliers = ApiSupplierController::getListSimple();
        $result = ApiProductController::create($params);
        $view = view('products.products', compact('notification', 'result', 'categories', 'suppliers'));
        return $view;
    }
}
