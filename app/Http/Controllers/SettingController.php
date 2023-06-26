<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;

class SettingController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_name = 'setting';
        // module model name, path
        $this->module_model = "App\Models\Setting";
        // page title
        $this->page_title = 'Setting';
        // page description
        $this->page_description = 'Setting';
        // module singular name
        $this->module_singular = 'Setting';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
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

    public function store(Request $request)
    {

        $validSettings = array_keys($request->all());

        foreach ($request->all() as $key => $val) {
            if (in_array($key, $validSettings)) {
                Setting::add($key, $val, Setting::getDataType($key));
            }
        }

        return redirect()->back()->with('status', 'Settings has been saved.');
    }
}
