<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventoryItemController extends Controller
{
    public function __construct()
    {
        // module name
        $this->module_name = 'inventory-items';
        // module model name, path
        $this->module_model = "App\Models\InventoryItem";
        // page title
        $this->page_title = 'Item';
        // page description
        $this->page_description = 'Item List';
        // module singular name
        $this->module_singular = 'Item';
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

    public function index_data() {
        $data = $this->module_model::select('*');
        return DataTables::of($data)
            ->addColumn('category_name', function ($data) {
                return $data->category->name;

            })
            ->addColumn('latest_stock', function ($data) {
                $latest_stock = $data->stocks()->latest()->first();
                return $latest_stock ? $latest_stock->quantity : 0 ;
            })
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                return view('components.action_column', compact('module_name', 'data'));
            })
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module_name = $this->module_name;
        $page_title = "Tambah $this->page_title";
        $page_description = $this->page_description;
        $action = 'default';
        $categories = InventoryCategory::all();
        return view("$module_name.create", compact('module_name', 'page_title', 'page_description', 'action', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            "is_available" => $request->is_available === "on" ? 1 : 0,
        ]);
        $module_name = $this->module_name;
        $module_data = $this->module_model::create($request->all());
        return redirect()->route("$module_name.index")->with('status', "$this->module_singular baru berhasil dibuat!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module_name = $this->module_name;
        $module_singular = $this->module_singular;
        $module_data = $this->module_model::findOrFail($id);
        $page_title = "Detail $this->page_title";
        $page_description = $this->page_description;
        $action = 'default';
        return view("$module_name.show", compact('module_name', 'page_title', 'page_description', 'action', 'module_data', 'module_singular'));
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
        $page_title = "Ubah $this->page_title";
        $page_description = $this->page_description;
        $action = 'default_index';
        $categories = InventoryCategory::all();
        return view("$module_name.edit", compact('module_name', 'page_title', 'page_description', 'action', 'module_data', 'categories'));
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
        $request->merge([
            "is_available" => $request->is_available === "on" ? 1 : 0,
        ]);
        $module_name = $this->module_name;
        $module_data = $this->module_model::findOrFail($id);
        $module_data->update($request->all());
        return redirect()->route("$module_name.index")->with('status',"$this->module_singular berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module_data = $this->module_model::findOrFail($id);
        $module_data->delete();
        return response()->json(['statusCode' => 200, 'message' => 'Data berhasil dihapus']);
    }
}
