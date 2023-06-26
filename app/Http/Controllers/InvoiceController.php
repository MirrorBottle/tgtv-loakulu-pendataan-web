<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;
class InvoiceController extends Controller
{
    public function __construct()
    {
        // module name
        $this->module_name = 'invoice';
        // page title
        $this->page_title = 'Invoice';
        // page description
        $this->page_description = 'Buat Invoice';
        // module singular name
        $this->module_singular = 'Invoice';
    }
    public function index()
    {
        $module_name = $this->module_name;
        $module_singular = $this->module_singular;
        $page_title = $this->page_title;
        $page_description = $this->page_description;
        $action = 'default_index';
        return view("$module_name.index", compact('page_title', 'page_description', 'action', 'module_name', 'module_singular'));
    }

    public function create(Request $request)
    {
        $file_name = "INVOICE_" . date("dmY");
        $destination = storage_path() . DIRECTORY_SEPARATOR . "$file_name.docx";
        $file = str_replace('/', DIRECTORY_SEPARATOR, storage_path("template") . DIRECTORY_SEPARATOR . "invoice.docx");
        $success = File::copy($file, $destination);
        $template = new TemplateProcessor($destination);
        $date = Carbon::createFromFormat("d-m-Y", $request->date);
        $values = $request->merge([
            "date" => $date->locale('id')->translatedFormat("l, d F Y"),
            "short_date" => $date->locale('id')->translatedFormat("d F Y"),
            "description" => str_replace("\r\n", "<w:br/>", $request->description)
        ])->toArray();
        $template->setValues($values);
        $template->saveAs($destination);
        return response()->download($destination)->deleteFileAfterSend(true);
    }
}
