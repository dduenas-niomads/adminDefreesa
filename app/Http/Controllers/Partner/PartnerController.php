<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Partner\ApiPartnerController;
use Auth;
use Carbon\Carbon;

class PartnerController extends Controller
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
            $view = view('partners.partners');
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
        $result = ApiPartnerController::update(isset($params['id']) ? (int)$params['id'] : null, $params);
        $view = view('partners.partners', compact('notification', 'result'));
        return $view;
    }

    public function deleteForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiPartnerController::delete(isset($params['id']) ? (int)$params['id'] : null);
        $view = view('partners.partners', compact('notification', 'result'));
        return $view;
    }
}
