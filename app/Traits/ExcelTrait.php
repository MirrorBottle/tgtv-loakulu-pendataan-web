<?php

namespace App\Traits;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Contract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Color;
use PhpOffice\PhpSpreadsheet\Style\Color as StyleColor;

trait ExcelTrait
{
  public function setExcelBorders($sheet, $cells) {
    $sheet->getStyle($cells)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
  }

  public function setExcelBorderTop($sheet, $cells, $color = 'FF0000FF') {
    $sheet->getStyle($cells)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor(new StyleColor($color));
  }

  public function setExcelBorderLeft($sheet, $cells, $color = 'FF0000FF') {
    $sheet->getStyle($cells)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor(new StyleColor($color));
  }

  public function setExcelBorderRight($sheet, $cells, $color = 'FF0000FF') {
    $sheet->getStyle($cells)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor(new StyleColor($color));
  }

  public function setExcelBorderBottom($sheet, $cells, $color = 'FF0000FF') {
    $sheet->getStyle($cells)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor(new StyleColor($color));
  }

  public function setExcelBorderTopBottom($sheet, $cells) {
    $this->setExcelBorderTop($sheet, $cells);
    $this->setExcelBorderBottom($sheet, $cells);
  }

  public function setExcelBold($sheet, $cells) {
    $sheet->getStyle($cells)->getFont()->setBold(true);
  }

  public function setExcelItalic($sheet, $cells) {
    $sheet->getStyle($cells)->getFont()->setItalic(true);
  }

  public function setExcelAlignments($sheet, $cells) {
    $sheet->getStyle($cells)->getAlignment()->setHorizontal('center')->setVertical('center');
  }

  public function setExcelLeftAlignments($sheet, $cells) {
    $sheet->getStyle($cells)->getAlignment()->setHorizontal('left')->setVertical('center');
  }

  public function setExcelStyle($sheet, $cells) {
    $this->setExcelAlignments($sheet, $cells);
    $this->setExcelBorders($sheet, $cells);
  }

  public function setExcelHeaderStyle($sheet, $cells) {
    $this->setExcelAlignments($sheet, $cells);
    $this->setExcelBorders($sheet, $cells);
    $this->setExcelBold($sheet, $cells);
  }
}
