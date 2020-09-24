<?php

namespace App\Http\Controllers\License;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\License\ApiLicenseController;
use Auth;

class LicenseController extends Controller
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
    public function upgrade()
    {
        if (Auth::user()) {
            $currentLicense = Auth::user()->active_license;
            $licenses = ApiLicenseController::getLicenses();
            $view = view('license.upgrade-plans', compact('currentLicense', 'licenses'));
        } else {
            $view = view('errors.403');
        }
        return $view;
    }

    public function upgradeTo($type)
    {
        $user = Auth::user();
        if ($user) {
            $currentLicense = $user->active_license;
            $license = ApiLicenseController::getLicenseByType($type);
            if (!is_null($license)) {
                if ($license['price'] > 0) {
                    $token = ApiLicenseController::generateToken();
                    $purchaseNumber = ApiLicenseController::generatePurchaseNumber();
                    $session = ApiLicenseController::generateSesion($license['price'], $token, $license['price']*1.10);
                    $view = view('license.upgrade-to', compact('user',
                        'currentLicense',
                        'license',
                        'purchaseNumber',
                        'token',
                        'session'));
                } else {
                    $token = null;
                    $purchaseNumber = ApiLicenseController::generatePurchaseNumber();
                    $session = null;
                    $view = view('license.upgrade-to', compact('user',
                        'currentLicense',
                        'license',
                        'purchaseNumber',
                        'token',
                        'session'));
                }
            } else {
                $view = view('errors.404');
            }
        } else {
            $view = view('errors.403');
        }
        return $view;
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $email = $request->get("customerEmail");
            $amount = $request->get("amount");
            $purchaseNumber = $request->get("purchaseNumber");
            $type = $request->get("type");
            if ($type === 'FREE') {
                $transactionToken = null;
                $token = null;
            } else {
                $transactionToken = $request->get("transactionToken");
                $token = ApiLicenseController::generateToken();
            }
            // create purchase backend
            $view = view('license.checkout', compact('user', 'transactionToken', 'amount', 'purchaseNumber', 'token', 'type'));
        } else {
            $view = view('errors.403');
        }
        return $view;
    }
}
