<?php

namespace App\Http\Controllers\MsProductCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\MsProductCategory\ApiMsProductCategoryController;
use Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class MsProductCategoryController extends Controller
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
            $view = view('categories.categories');
        } else {
            $view = view('errors.403');
        }
        return $view;
    }
}
