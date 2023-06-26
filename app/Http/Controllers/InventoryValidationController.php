<?php

namespace App\Http\Controllers;

use App\Http\Resources\Web\InventoryLogItemsResource;
use App\Models\InventoryItem;
use App\Models\InventoryStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventoryValidationController extends Controller
{
  public function __construct()
  {
    // module name
    $this->module_name = 'inventory-validations';
    // module model name, path
    $this->module_model = "App\Models\InventoryLog";
    // page title
    $this->page_title = 'Validasi';
    // page description
    $this->page_description = 'Validasi List';
    // module singular name
    $this->module_singular = 'Validasi';
  }

  public function index()
  {
    $module_name = $this->module_name;
    $module_singular = $this->module_singular;
    $module_data = $this->module_model::paginate();
    $page_title = $this->page_title;
    $page_description = $this->page_description;
    $action = 'default';
    return view("$module_name.index", compact('page_title', 'page_description', 'action', 'module_data', 'module_name', 'module_singular'));
  }

  public function index_data()
  {
    $data = $this->module_model::with('user', 'stocks')
      ->select('*')
      ->where("validation_status", 1);
    return DataTables::of($data)
      ->editColumn('date', function ($data) {
        return $data->date->format("H:i");
      })
      ->addColumn('user_name', function ($data) {
        return $data->user->name;
      })
      ->addColumn('items', function ($data) {
        return InventoryLogItemsResource::collection($data->stocks)->toJson();
      })
      ->addColumn('action', function ($data) {
        $module_name = $this->module_name;
        return view("$module_name.action_column", compact('module_name', 'data'));
      })
      ->toJson();
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $module_name = $this->module_name;
    $module_data = $this->module_model::findOrFail($id);
    $page_title = "Tolak $this->page_title";
    $page_description = $this->page_description;
    $action = 'default_index';
    return view("$module_name.edit", compact('module_name', 'page_title', 'page_description', 'action', 'module_data'));
  }

  public function confirmed($id) {
    $module_data = $this->module_model::findOrFail($id);
    $module_data->update([
      "validation_status" => 2,
      "admin_id" => auth()->user()->id,
      "validated_at" => Carbon::now()->toDateTimeString()
    ]);
    return response()->json(['statusCode' => 200, 'message' => 'Data berhasil diubah']);
  }

  public function bulk() {
    $this->module_model::where("validation_status", 1)
    ->update([
      "validation_status" => 2,
      "admin_id" => auth()->user()->id,
      "validated_at" => Carbon::now()->toDateTimeString()
    ]);
    return response()->json(['statusCode' => 200, 'message' => 'Data berhasil diubah']);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $module_name = $this->module_name;
    $module_data = $this->module_model::findOrFail($id);
    $module_data->update($request->all());
    return redirect()->route("$module_name.index")->with('status', "$this->module_singular berhasil diubah!");
  }
}
