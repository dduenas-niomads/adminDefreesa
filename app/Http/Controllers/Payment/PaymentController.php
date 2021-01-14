<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Payment\ApiPaymentController;
use App\Http\Controllers\Supplier\ApiSupplierController;
use Auth;
use Carbon\Carbon;

class PaymentController extends Controller
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
        $suppliers = ApiSupplierController::getListSimple();
        $view = view('payments.payments', compact('suppliers'));
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

    public function updateForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $suppliers = ApiSupplierController::getListSimple();
        $result = ApiPaymentController::update(isset($params['id']) ? (int)$params['id'] : null, $params);
        $view = view('payments.payments', compact('notification', 'suppliers', 'result'));
        return $view;
    }

    public function deleteForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $suppliers = ApiSupplierController::getListSimple();
        $result = ApiPaymentController::delete(isset($params['id']) ? (int)$params['id'] : null);
        $view = view('payments.payments', compact('notification', 'suppliers', 'result'));
        return $view;
    }

    public function createForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $suppliers = ApiSupplierController::getListSimple();
        $result = ApiPaymentController::create($params);
        $view = view('payments.payments', compact('notification', 'result', 'suppliers'));
        return $view;
    }
}
