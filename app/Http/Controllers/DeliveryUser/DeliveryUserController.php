<?php

namespace App\Http\Controllers\DeliveryUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\DeliveryUser\ApiDeliveryUserController;
use Auth;
use Carbon\Carbon;

class DeliveryUserController extends Controller
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
            $view = view('delivery-users.delivery-users');
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
