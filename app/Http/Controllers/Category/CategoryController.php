<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Category\ApiCategoryController;
use Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
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

    public function updateForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $params['url_image'] = $this->uploadImage($params['file']);
        $result = ApiCategoryController::update(isset($params['id']) ? (int)$params['id'] : null, $params);
        $view = view('categories.categories', compact('notification', 'result'));
        return $view;
    }

    public function deleteForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiCategoryController::delete(isset($params['id']) ? (int)$params['id'] : null);
        $view = view('categories.categories', compact('notification', 'result'));
        return $view;
    }

    public function createForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiCategoryController::create($params);
        $view = view('categories.categories', compact('notification', 'result'));
        return $view;
    }

    public function uploadFile(Request $request)
    {
        request()->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($files = $request->file('file')) {

            $file->save();

            return Response()->json(Response::HTTP_OK);
 
        }
 
    }
}
