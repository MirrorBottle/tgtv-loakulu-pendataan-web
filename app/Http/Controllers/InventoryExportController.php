<?php

namespace App\Http\Controllers;

use App\Http\Resources\Web\InventoryLogItemsResource;
use App\Models\InventoryItem;
use App\Models\InventoryLog;
use App\Models\InventoryStock;
use App\Traits\ExcelTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class InventoryExportController extends Controller
{
  use ExcelTrait;
  public function __construct()
  {
    // module name
    $this->module_name = 'inventory-export';
    // page title
    $this->page_title = 'Export Laporan';
    // page description
    $this->page_description = 'Export Laporan';
    // module singular name
    $this->module_singular = 'Export Laporan';
  }
  public function view($type)
  {
    $module_name = $this->module_name;
    $module_singular = $this->module_singular;
    $page_title = $this->page_title;
    $page_description = $this->page_description;
    $action = 'default';

    $items = InventoryItem::all();
    return view("$module_name.index", compact('page_title', 'page_description', 'action', 'module_name', 'module_singular', 'type', 'items'));
  }

  private function inventoryLogs($request, $query, $type)
  {
    $inventory_log_ids = $query->where('type', $type)
      ->orderBy('created_at', 'desc')
      ->pluck('id');

    $items = InventoryStock::whereIn('inventory_log_id', $inventory_log_ids)
      ->when(!in_array("all", $request->items), function ($query) use ($request) {
        return $query->whereIn('inventory_item_id', $request->items);
      })
      ->get();
    $inventory_logs = $inventory_log_ids
      ->map(function($log_id) use ($items) {
        return (object)[
          "id" => $log_id,
          "items" => $items->filter(function($item) use ($log_id) {
            return $item->inventory_log_id == $log_id;
          })->values()
        ];
      })
      ->toArray();

    $column_alphanumerics = range('A', 'G');
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->setActiveSheetIndex(0);
    $column = 1;
    $number = 1;
    // Set Header
    foreach ($column_alphanumerics as $column_alphanumeric) {
      $sheet->setCellValue("A$column", "No")
        ->setCellValue("B$column", "Kode Log")
        ->setCellValue("C$column", "Nama")
        ->setCellValue("D$column", "Tanggal")
        ->setCellValue("E$column", "Item")
        ->setCellValue("F$column", "Jumlah")
        ->setCellValue("G$column", "Catatan")
        ->getColumnDimension($column_alphanumeric)
        ->setAutoSize(true);
      $this->setExcelHeaderStyle($sheet, "A$column:F$column");
    }
    $column++;
    foreach($inventory_logs as $log) {
      $prev_column = $column;
      foreach ($log->items as $item_key => $item) {
        $quantity = $item->decrease == 0 ? $item->increase : $item->decrease;
        $sheet->setCellValue("A$column", $number)
          ->setCellValue("B$column", $item->log->code)
          ->setCellValue("C$column", $item->log->user->name)
          ->setCellValue("D$column", $item->log->date->format("d-m-Y"))
          ->setCellValue("E$column", " ({$item->item->code}) {$item->item->name}")
          ->setCellValue("F$column", "{$quantity} {$item->item->unit}")
          ->setCellValue("G$column", $item->log->note)
          ->getColumnDimension($column_alphanumeric)
          ->setAutoSize(true);
        $this->setExcelStyle($sheet, "A$column:G$column");
        $column++;
      }
      $number++;
      $cur_column = $column - 1;
      $sheet->mergeCells("A$prev_column:A$cur_column");
      $sheet->mergeCells("B$prev_column:B$cur_column");
      $sheet->mergeCells("C$prev_column:C$cur_column");
      $sheet->mergeCells("D$prev_column:D$cur_column");
      $sheet->mergeCells("G$prev_column:G$cur_column");
    }

    $file_name = $type == InventoryLog::$INVENTORY_IN ? '[ANANDITA - LAPORAN ITEM MASUK]' : '[ANANDITA - LAPORAN ITEM KELUAR MASUK]';
    $file_name = $file_name . date('d-m-Y');

    return [
      "file_name" => $file_name,
      "spreadsheet" => $spreadsheet
    ];
  }

  private function inventoryStock($request) {
    $dates = explode(" - ", $request->daterange);
    $start_date = Carbon::createFromFormat("d/m/Y", $dates[0])->format('Y-m-d');
    $end_date = Carbon::createFromFormat("d/m/Y", $dates[1])->format('Y-m-d');

    $items = InventoryStock::whereBetween('date', [$start_date, $end_date])
      ->when(!in_array("all", $request->items), function ($query) use ($request) {
        return $query->whereIn('inventory_item_id', $request->items);
      })
      ->orderBy('inventory_item_id')
      ->orderBy('date')
      ->get();

    $column_alphanumerics = range('A', 'H');
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->setActiveSheetIndex(0);
    $column = 1;
    $number = 1;
    // Set Header
    foreach ($column_alphanumerics as $column_alphanumeric) {
      $sheet->setCellValue("A$column", "No")
        ->setCellValue("B$column", "Kode Log")
        ->setCellValue("C$column", "Pegawai")
        ->setCellValue("D$column", "Tanggal")
        ->setCellValue("E$column", "Item")
        ->setCellValue("F$column", "Keluar")
        ->setCellValue("G$column", "Masuk")
        ->setCellValue("H$column", "Tersisa")
        ->getColumnDimension($column_alphanumeric)
        ->setAutoSize(true);
      $this->setExcelHeaderStyle($sheet, "A$column:H$column");
    }
    $column++;
    foreach ($items as $item) {
      $quantity = $item->decrease == 0 ? $item->increase : $item->decrease;

      $sheet->setCellValue("A$column", $number)
        ->setCellValue("B$column", $item->log->code)
        ->setCellValue("C$column", $item->log->user->name)
        ->setCellValue("D$column", $item->log->date->format("d-m-Y"))
        ->setCellValue("E$column", "({$item->item->code}) {$item->item->name}")
        ->setCellValue("F$column", "{$item->decrease} {$item->item->unit}")
        ->setCellValue("G$column", "{$item->increase} {$item->item->unit}")
        ->setCellValue("H$column", "{$item->quantity} {$item->item->unit}")
        ->getColumnDimension($column_alphanumeric)
        ->setAutoSize(true);
      $this->setExcelStyle($sheet, "A$column:H$column");
      $number++;
      $column++;
    }
    $file_name = "[ANANDITA - HISTORY STOCK]" . date('d-m-Y');

    return [
      "file_name" => $file_name,
      "spreadsheet" => $spreadsheet
    ];
  }

  private function inventoryCurrentStock($request) {
    $dates = explode(" - ", $request->daterange);
    $start_date = Carbon::createFromFormat("d/m/Y", $dates[0])->format('Y-m-d');
    $end_date = Carbon::createFromFormat("d/m/Y", $dates[1])->format('Y-m-d');

    $items = InventoryStock::whereBetween('date', [$start_date, $end_date])
      ->when(!in_array("all", $request->items), function ($query) use ($request) {
        return $query->whereIn('inventory_item_id', $request->items);
      })
      ->orderBy('inventory_item_id')
      ->latest()
      ->get()
      ->unique('inventory_item_id');

    $column_alphanumerics = range('A', 'E');
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->setActiveSheetIndex(0);
    $column = 1;
    $number = 1;
    // Set Header
    foreach ($column_alphanumerics as $column_alphanumeric) {
      $sheet->setCellValue("A$column", "No")
        ->setCellValue("B$column", "Tanggal")
        ->setCellValue("C$column", "Kode Item")
        ->setCellValue("D$column", "Nama Item")
        ->setCellValue("E$column", "Tersisa")
        ->getColumnDimension($column_alphanumeric)
        ->setAutoSize(true);
      $this->setExcelHeaderStyle($sheet, "A$column:E$column");
    }
    $column++;
    foreach ($items as $item) {
      $quantity = $item->decrease == 0 ? $item->increase : $item->decrease;

      $sheet->setCellValue("A$column", $number)
        ->setCellValue("B$column", $item->log ? $item->log->date->format("d-m-Y") : '-')
        ->setCellValue("C$column", $item->item->code)
        ->setCellValue("D$column", $item->item->name)
        ->setCellValue("E$column", "{$item->quantity} {$item->item->unit}")
        ->getColumnDimension($column_alphanumeric)
        ->setAutoSize(true);
      $this->setExcelStyle($sheet, "A$column:E$column");
      $number++;
      $column++;
    }
    $file_name = "[ANANDITA - STOCK]" . date('d-m-Y');

    return [
      "file_name" => $file_name,
      "spreadsheet" => $spreadsheet
    ];
  }

  public function export(Request $request, $type)
  {
    $dates = explode(" - ", $request->daterange);
    $start_date = Carbon::createFromFormat("d/m/Y", $dates[0])->format('Y-m-d');
    $end_date = Carbon::createFromFormat("d/m/Y", $dates[1])->format('Y-m-d');
    $query = InventoryLog::query()
      ->whereBetween('date', [$start_date, $end_date]);

    switch ($type) {
      case 'inventory-logs-in':
        $export = $this->inventoryLogs($request, $query, InventoryLog::$INVENTORY_IN);
        break;
      case 'inventory-logs-out':
        $export = $this->inventoryLogs($request, $query, InventoryLog::$INVENTORY_OUT);
        break;
      case 'inventory-stock':
        $export = $this->inventoryStock($request);
        break;
      case 'inventory-current-stock':
        $export = $this->inventoryCurrentStock($request);
        break;
      default:
        # code...
        break;
    }
    $spreadsheet = $export['spreadsheet'];
    $file_name = $export['file_name'];
    ob_end_clean();
    header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx"');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
  }
}
