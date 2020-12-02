<?php

namespace App\Http\Controllers\MsRegion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\MsRegion\ApiMsRegionController;
use App\Http\Controllers\Category\ApiCategoryController;
use Auth;
use Carbon\Carbon;

class MsRegionController extends Controller
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
        //
    }

    public function updateForm(Request $request)
    {
        //
    }

    public function deleteForm(Request $request)
    {
        //
    }

    public function createForm(Request $request)
    {
        //
    }
}
