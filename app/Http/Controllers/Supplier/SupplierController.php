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
}
