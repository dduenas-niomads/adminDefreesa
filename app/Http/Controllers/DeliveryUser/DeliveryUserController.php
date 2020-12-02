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

    public function updateForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiDeliveryUserController::update(isset($params['id']) ? (int)$params['id'] : null, $params);
        $view = view('delivery-users.delivery-users', compact('notification', 'result'));
        return $view;
    }

    public function deleteForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiDeliveryUserController::delete(isset($params['id']) ? (int)$params['id'] : null);
        $view = view('delivery-users.delivery-users', compact('notification', 'result'));
        return $view;
    }
}
