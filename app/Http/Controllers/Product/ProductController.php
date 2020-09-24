<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Product\ApiProductController;
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
        if (Auth::user()) {
            $view = view('products.products');
        } else {
            $view = view('errors.403');
        }
        return $view;
    }

    public function edit($id)
    {
        if (Auth::user()) {
            dd($id);
        } else {
            $view = view('errors.403');
        }
        return $view;
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        dd($id, $params);
    }

    public function updateForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiProductController::update(isset($params['id']) ? (int)$params['id'] : null, $params);
        $view = view('products.products', compact('notification', 'result'));
        return $view;
    }

    public function deleteForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiProductController::delete(isset($params['id']) ? (int)$params['id'] : null);
        $view = view('products.products', compact('notification', 'result'));
        return $view;
    }

    public function createForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiProductController::create($params);
        $view = view('products.products', compact('notification', 'result'));
        return $view;
    }
}
