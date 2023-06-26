<?php

namespace App\Http\Controllers;

use App\Http\Resources\Web\InventoryLogItemsResource;
use App\Models\InventoryItem;
use App\Models\InventoryStock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventoryLogController extends Controller
{
    public function __construct()
    {
        // module name
        $this->module_name = 'inventory-logs';
        // module model name, path
        $this->module_model = "App\Models\InventoryLog";
        // page title
        $this->page_title = 'Stok';
        // page description
        $this->page_description = 'Stok List';
        // module singular name
        $this->module_singular = 'Stok';
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
        $data = $this->module_model::with('user', 'items')->select('*');
        return DataTables::of($data)
            ->addColumn('datetime', function($data) {
                return $data->created_at->format("d/m/Y H:i");
            })
            ->addColumn('user_name', function($data) {
                return $data->user->name;
            })
            ->addColumn('items', function ($data) {
                return InventoryLogItemsResource::collection($this->stocks);
            })
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                return view('components.action_column', compact('module_name', 'data'));
            })
            ->toJson();
    }

    public function in()
    {
        $module_name = $this->module_name;
        $module_singular = $this->module_singular;
        $module_data = $this->module_model::paginate();
        $page_title = $this->page_title;
        $page_description = $this->page_description;
        $action = 'default';
        return view("$module_name.in", compact('page_title', 'page_description', 'action', 'module_data', 'module_name', 'module_singular'));
    }

    public function in_data() {
        $data = $this->module_model::with('user', 'stocks')->select('*')->where("type", 2);
        return DataTables::of($data)
            ->editColumn('date', function($data) {
                return $data->date->format("d/m/Y H:i");
            })
            ->addColumn('user_name', function($data) {
                return $data->user->name;
            })
            ->addColumn('items', function ($data) {
                return InventoryLogItemsResource::collection($data->stocks)->toJson();
            })
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                return view('components.action_column', compact('module_name', 'data'));
            })
            ->toJson();
    }

    public function out()
    {
        $module_name = $this->module_name;
        $module_singular = $this->module_singular;
        $module_data = $this->module_model::paginate();
        $page_title = $this->page_title;
        $page_description = $this->page_description;
        $action = 'default';
        return view("$module_name.out", compact('page_title', 'page_description', 'action', 'module_data', 'module_name', 'module_singular'));
    }

    public function out_data() {
        $data = $this->module_model::with('user', 'stocks')->select('*')->where("type", 1);
        return DataTables::of($data)
            ->editColumn('date', function($data) {
                return $data->date->format("d/m/Y H:i");
            })
            ->addColumn('user_name', function($data) {
                return $data->user->name;
            })
            ->addColumn('items', function ($data) {
                return InventoryLogItemsResource::collection($data->stocks)->toJson();
            })
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                return view('components.action_column', compact('module_name', 'data'));
            })
            ->toJson();
    }

    public function all()
    {
        $module_name = $this->module_name;
        $module_singular = $this->module_singular;
        $module_data = InventoryStock::paginate();
        $page_title = $this->page_title;
        $page_description = $this->page_description;
        $action = 'default';
        $items = InventoryItem::all();
        return view("$module_name.all", compact('page_title', 'page_description', 'action', 'module_data', 'module_name', 'module_singular', 'items'));
    }

    public function all_data() {
        $data = InventoryStock::with('item', 'log')->select('inventory_stocks.*')->orderBy("id", "desc");
        return DataTables::of($data)
            ->editColumn('date', function($data) {
                return $data->date->format("d/m/Y H:i");
            })
            ->addColumn('user_name', function($data) {
                return $data->log->user->name;
            })
            ->addColumn('item_name', function ($data) {
                return $data->item->name;
            })
            ->addColumn('item_unit', function ($data) {
                return $data->item->unit;
            })
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                return view('components.action_column', compact('module_name', 'data'));
            })
            ->toJson();
    }

    public function items()
    {
        $module_name = $this->module_name;
        $module_singular = $this->module_singular;
        $module_data = $this->module_model::paginate();
        $page_title = $this->page_title;
        $page_description = $this->page_description;
        $action = 'default';
        return view("$module_name.items", compact('page_title', 'page_description', 'action', 'module_data', 'module_name', 'module_singular'));
    }

    public function items_data() {
        $data = $this->module_model::with('user', 'items')->select('*')->where("type", 1);
        return DataTables::of($data)
            ->editColumn('date', function($data) {
                return $data->date->format("d/m/Y H:i");
            })
            ->addColumn('user_name', function($data) {
                return $data->user->name;
            })
            ->addColumn('items', function ($data) {
                return InventoryLogItemsResource::collection($data->stocks)->toJson();
            })
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                return view('components.action_column', compact('module_name', 'data'));
            })
            ->toJson();
    }

    public function item()
    {
        $module_name = $this->module_name;
        $module_singular = $this->module_singular;
        $module_data = $this->module_model::paginate();
        $page_title = $this->page_title;
        $page_description = $this->page_description;
        $action = 'default';
        return view("$module_name.item", compact('page_title', 'page_description', 'action', 'module_data', 'module_name', 'module_singular'));
    }

    public function item_data() {
        $data = $this->module_model::with('user', 'items')->select('*')->where("type", 1);
        return DataTables::of($data)
            ->editColumn('date', function($data) {
                return $data->date->format("d/m/Y H:i");
            })
            ->addColumn('user_name', function($data) {
                return $data->user->name;
            })
            ->addColumn('items', function ($data) {
                return InventoryLogItemsResource::collection($data->stocks)->toJson();
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
        return view("$module_name.create", compact('module_name', 'page_title', 'page_description', 'action'));
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
        return view("$module_name.edit", compact('module_name', 'page_title', 'page_description', 'action', 'module_data'));
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
