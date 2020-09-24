<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Warehouse\ApiWarehouseController;
use Auth;
use Carbon\Carbon;

class WarehouseController extends Controller
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
        $view = view('warehouses.warehouses');
        return $view;
    }

    public function edit($id)
    {
        $warehouse = ApiWarehouseController::getWarehouseById($id);
        dd($warehouse);
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        dd($id, $params);
    }

    public function updateSeriesForm($params = [])
    {
        $notification = true;
        $series = [ 'series' => [
            '00' => [
                'serie' => isset($params['serieModalSerie00']) ? $params['serieModalSerie00'] : "P001",
                'number' => isset($params['serieModalNumber00']) ? $params['serieModalNumber00'] : "1"
            ], '01' => [
                'serie' => isset($params['serieModalSerie01']) ? $params['serieModalSerie01'] : "F001",
                'number' => isset($params['serieModalNumber01']) ? $params['serieModalNumber01'] : "1"
            ], '03' => [
                'serie' => isset($params['serieModalSerie03']) ? $params['serieModalSerie03'] : "B001",
                'number' => isset($params['serieModalNumber03']) ? $params['serieModalNumber03'] : "1"
            ], '09' => [
                'serie' => isset($params['serieModalSerie09']) ? $params['serieModalSerie09'] : "T001",
                'number' => isset($params['serieModalNumber09']) ? $params['serieModalNumber09'] : "1"
            ]
        ]];
        $result = ApiWarehouseController::update(isset($params['id']) ? (int)$params['id'] : null, $series);
        $view = view('warehouses.warehouses', compact('notification', 'result'));
        return $view;
    }

    public function updateForm(Request $request)
    {
        $params = $request->all();
        if (isset($params['series'])) {
            return $this->updateSeriesForm($params);
        }
        $notification = true;
        $result = ApiWarehouseController::update(isset($params['id']) ? (int)$params['id'] : null, $params);
        $view = view('warehouses.warehouses', compact('notification', 'result'));
        return $view;
    }

    public function deleteForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiWarehouseController::delete(isset($params['id']) ? (int)$params['id'] : null);
        $view = view('warehouses.warehouses', compact('notification', 'result'));
        return $view;
    }

    public function createForm(Request $request)
    {
        $params = $request->all();
        $notification = true;
        $result = ApiWarehouseController::create($params);
        $view = view('warehouses.warehouses', compact('notification', 'result'));
        return $view;
    }
}
