<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
class UserController extends Controller
{
    public function __construct()
    {
        // module name
        $this->module_name = 'users';
        // module model name, path
        $this->module_model = "App\Models\User";
        // page title
        $this->page_title = 'User';
        // page description
        $this->page_description = 'User List';
        // module singular name
        $this->module_singular = 'User';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module_name = $this->module_name;
        $module_data = $this->module_model::paginate();
        $page_title = $this->page_title;
        $page_description = $this->page_description;
        $action = 'user_index';
        return view("$module_name.index", compact('page_title', 'page_description', 'action', 'module_data', 'module_name'));
    }

    public function index_data() {
        $data = $this->module_model::select('id', 'name', 'email');
        return DataTables::of($data)
            ->addColumn('role', function ($data) {
                return $data->getRoleNames()->first();
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
        $action = 'user_index';
        $roles = Role::all();
        return view("$module_name.create", compact('module_name', 'page_title', 'page_description', 'action', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $module_name = $this->module_name;
        transaction_store(function() use($request) {
            $module_data = $this->module_model::create($request->all());
            $role = Role::findById($request->role);
            $module_data->syncRoles($role);
        });
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
        //
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
        $action = 'user_index';
        $roles = Role::all();
        return view("$module_name.edit", compact('module_name', 'page_title', 'page_description', 'action', 'module_data', 'roles', 'units'));
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
        if($request->has('role')) {
            $role = Role::findById($request->role);
            $module_data->syncRoles($role);
        }
        $message = $request->has('role') ? "$this->module_singular berhasil diubah!" : "Data profil berhasil diubah";
        return $request->has('role') ? redirect()->route("$module_name.index")->with('status', $message) : redirect()->route("$module_name.profile")->with('status', $message);
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
        $module_data->unit()->update(['total' => $module_data->unit->total - 1]);
        $module_data->delete();
        return response()->json(['statusCode' => 200, 'message' => 'Data berhasil dihapus']);
    }


    public function profile()
    {
        $module_name = $this->module_name;
        $page_title = "Profil";
        $page_description = $this->page_description;
        $action = 'user_index';
        $user = auth()->user();
        return view("$module_name.profile", compact('module_name', 'page_title', 'page_description', 'action', 'user'));
    }

    public function change_password(Request $request, $id) {
        $module_name = $this->module_name;
        $module_data = $this->module_model::findOrFail($id);
        $module_data->password = Hash::make($request->password);
        $module_data->save();
        return redirect()->route("$module_name.profile")->with('status', "Password berhasil diubah!");
    }
}
