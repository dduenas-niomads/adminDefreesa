<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Company\ApiCompanyController;
use Auth;

class CompanyController extends Controller
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
    public function myCompany()
    {
        if (self::superAdminRole()) {
            $currentLicense = Auth::user()->active_license;
            $currentLicense['days_available'] = ApiCompanyController::dateDiff($currentLicense['date_end']);
            $company = ApiCompanyController::getMyCompany();
            $categories = ApiCompanyController::getCompanyCategories();
            $currencies = $company['currencies'];
            $countries = $company['countries'];
            $view = view('company.my-company', compact('company', 'currentLicense', 'categories', 'currencies', 'countries'));
        } else {
            $view = view('errors.403');
        }
        return $view;
    }

    public function updateMyCompany(Request $request)
    {
        $company = ApiCompanyController::updateMyCompany($request->all());
        if (!is_null($company)) {
            return redirect('my-company');
        } else {
            return view('errors.400');
        }
    }
}
