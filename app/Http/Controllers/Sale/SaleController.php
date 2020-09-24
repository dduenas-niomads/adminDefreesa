<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class SaleController extends Controller
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
        $view = view('sales.sales');
        return $view;
    }

    public function newSale()
    {
        $view = view('sales.new-sale');
        return $view;
    }

    public function electronicInvoice()
    {
        if (self::superAdminRole()) {
            $view = view('sales.electronic-invoice');
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
}
