<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Account\ApiAccountController;
use Auth;
use Carbon\Carbon;

class AccountController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myAccount()
    {
        $account = ApiAccountController::getMyAccount();
        $memberSince = new Carbon($account['created_at']);
        $account['member_since'] = $memberSince->toDateString();
        return view('account.my-account', compact('account'));
    }

    public function updateMyAccount(Request $request)
    {
        $account = ApiAccountController::updateMyAccount($request->all());
        if (!is_null($account)) {
            return redirect('my-account');
        } else {
            return view('errors.400');
        }
    }

    public function logoutAll()
    {
        $account = ApiAccountController::logoutAll();
        return redirect('login');
    }
}
