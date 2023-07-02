<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebInboxRequest;
use App\Models\Experience;
use App\Models\Family;
use App\Models\Gallery;
use App\Models\Inbox;
use App\Models\Mission;
use App\Models\Neighborhood;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Villager;
use App\Models\Visitor;
use App\Traits\ExcelTrait;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Artesaos\SEOTools\Facades\SEOTools;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class WebController extends Controller
{
    use ExcelTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEOTools::setTitle(setting('app_name'));
        SEOTools::setDescription(setting('about_description'));
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::opengraph()->addImage(asset(setting('about_image')), [
            'height' => 500,
            'width' => 800
        ]);
        SEOTools::setCanonical(url('/'));
        SEOTools::twitter()->setSite(setting('app_name'));
        SEOTools::twitter()->setDescription(setting('about_description'));
        SEOTools::twitter()->setImage(asset(setting('about_image')));
        SEOTools::jsonLd()->addImage(asset(setting('about_image')));

        $agent = new Agent();
        $ip = request()->ip();
        $device = $agent->platform() . ', ' . $agent->browser();
        $check = Visitor::exist($ip);
        if (!$check) {
            Visitor::create([
                'ip_address' => $ip,
                'device' => $device,
                'visitor' => 1
            ]);
        }
        
        return view('web.index');
    }

    public function upload_view()
    {
        SEOTools::setTitle(setting('app_name'));
        SEOTools::setDescription(setting('about_description'));
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::opengraph()->addImage(asset(setting('about_image')), [
            'height' => 500,
            'width' => 800
        ]);
        SEOTools::setCanonical(url('/'));
        SEOTools::twitter()->setSite(setting('app_name'));
        SEOTools::twitter()->setDescription(setting('about_description'));
        SEOTools::twitter()->setImage(asset(setting('about_image')));
        SEOTools::jsonLd()->addImage(asset(setting('about_image')));

        
        return view('web.upload');
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $neighborhood_id = 14;

        $spreadsheet = IOFactory::load($file);

        $sheet = $spreadsheet->getActiveSheet();

        $highestRow = $sheet->getHighestRow();

        $villagers = collect();
        for ($row = 6; $row <= $highestRow; $row++) {
            $births = explode(",", $sheet->getCell("E$row")->getValue());
            $gender = strtolower($sheet->getCell("H$row")->getValue());
            $marital_status = preg_replace('/\s+/','',$sheet->getCell("I$row")->getValue());
            try {
                $villagers->add([
                    "name"            => $sheet->getCell("B$row")->getValue(),
                    "neighborhood_id" => $neighborhood_id,
                    "id_number"       => $sheet->getCell("C$row")->getValue(),
                    "family_id"       => (string) $sheet->getCell("D$row")->getValue(),
                    "birth_place"     => $births[0],
                    "birth_date"      => Carbon::createFromFormat("d-m-Y", str_replace(' ', '', $births[1]))->format("Y-m-d"),
                    "religion"        => strtoupper(preg_replace('/\s+/','',$sheet->getCell("F$row")->getValue())),
                    "gender"          => strpos($gender, "p") !== false ? "P" : "L",
                    "marital_status"  => $marital_status == "" ? "BK" : $marital_status,
                    "job"             => $sheet->getCell("J$row")->getValue() ?? "-",
                    "father_name"     => $sheet->getCell("K$row")->getValue() ?? "-",
                    "mother_name"     => $sheet->getCell("L$row")->getValue() ?? "-",
                    "education"       => $sheet->getCell("M$row")->getValue() ?? "LAINNYA",
                    "address"         => $sheet->getCell("N$row")->getValue() ?? "-",
                    "created_at"      => Carbon::now()->toDateTimeString(),
                    "updated_at"      => Carbon::now()->toDateTimeString(),
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage(), $births);
            }
        }

        $family_numbers = $villagers->groupBy('family_id');

        foreach($family_numbers as $key => $family_member) {
            $family = Family::where('number', $key)->first();

            if(!$family) {
                $family = Family::create([
                    "neighborhood_id" => $neighborhood_id,
                    "number" => $key,
                    "head_family" => $family_member[0]['name'],
                    "total_member" => count($family_member),
                    "address" => $family_member[0]['address'] ?? "-",
                ]);
            }
            $villagers = $family_member
                ->map(function($member) use ($family) {
                    $member['family_id'] = $family->id;
                    return $member;
                })
                ->toArray();

            foreach($villagers as $villager) {
                Villager::firstOrCreate(['id_number' => $villager['id_number']], $villager);
            }
        }

        return redirect()->back()->with('success', 'Data penduduk berhasil dimasukkan!');
    }

    public function report_view(Request $request) {
        SEOTools::setTitle(setting('app_name'));
        SEOTools::setDescription(setting('about_description'));
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::opengraph()->addImage(asset(setting('about_image')), [
            'height' => 500,
            'width' => 800
        ]);
        SEOTools::setCanonical(url('/'));
        SEOTools::twitter()->setSite(setting('app_name'));
        SEOTools::twitter()->setDescription(setting('about_description'));
        SEOTools::twitter()->setImage(asset(setting('about_image')));
        SEOTools::jsonLd()->addImage(asset(setting('about_image')));
        
        return view('web.report');
    }

    /**
     * 
     *
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public function generateReportByFamily($spreadsheet, $data) {
        $column_alphanumerics = range('A', 'O');
        $row = 6;
        $number = 1;
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        
        $families = $data->groupBy('family_id');
        foreach($families as $family_id => $family_members) {
            foreach($family_members as $key => $member) {
                $sheet
                    ->setCellValue("A$row", $number)
                    ->setCellValue("B$row", $member->name)
                    ->setCellValue("E$row", $member->birth_place . ", " . $member->birth_date->format("d-m-Y"))
                    ->setCellValue("F$row", $member->religion)
                    ->setCellValue("G$row", $member->age)
                    ->setCellValue("H$row", $member->gender)
                    ->setCellValue("I$row", $member->marital_status)
                    ->setCellValue("J$row", $member->job)
                    ->setCellValue("K$row", $member->father_name)
                    ->setCellValue("L$row", $member->mother_name)
                    ->setCellValue("M$row", $member->education)
                    ->setCellValue("O$row", $member->address);
                $this->setExcelStyle($sheet, "A$row:O$row");

                $sheet
                    ->getCell("C$row")
                    ->getStyle()
                    ->getNumberFormat()
                    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

                $sheet
                    ->getCell("C$row")
                    ->setValueExplicit($member->id_number, DataType::TYPE_STRING);

                $sheet
                    ->getCell("D$row")
                    ->getStyle()
                    ->getNumberFormat()
                    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

                $sheet
                    ->getCell("D$row")
                    ->setValueExplicit($member->family->number, DataType::TYPE_STRING);

                $this->setExcelLeftAlignments($sheet, "B$row");
                $this->setExcelLeftAlignments($sheet, "E$row");

                if($key == 0) {
                    $this->setExcelBold($sheet, "A$row:O$row");
                }

                $number++;
                $row++;
            }
        }
        
        return $spreadsheet;
    }

    /**
     * 
     *
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public function generateReportByPerson($spreadsheet, $data) {
        $column_alphanumerics = range('A', 'O');
        $row = 6;
        $number = 1;
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        
        foreach($data as $key => $member) {
            $sheet
                ->setCellValue("A$row", $number)
                ->setCellValue("B$row", $member->name)
                ->setCellValue("E$row", $member->birth_place . ", " . $member->birth_date->format("d-m-Y"))
                ->setCellValue("F$row", $member->religion)
                ->setCellValue("G$row", $member->age)
                ->setCellValue("H$row", $member->gender)
                ->setCellValue("I$row", $member->marital_status)
                ->setCellValue("J$row", $member->job)
                ->setCellValue("K$row", $member->father_name)
                ->setCellValue("L$row", $member->mother_name)
                ->setCellValue("M$row", $member->education)
                ->setCellValue("O$row", $member->address);
            $this->setExcelStyle($sheet, "A$row:O$row");

            $sheet
                ->getCell("C$row")
                ->getStyle()
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

            $sheet
                ->getCell("C$row")
                ->setValueExplicit($member->id_number, DataType::TYPE_STRING);

            $sheet
                ->getCell("D$row")
                ->getStyle()
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

            $sheet
                ->getCell("D$row")
                ->setValueExplicit($member->family->number, DataType::TYPE_STRING);

            $this->setExcelLeftAlignments($sheet, "B$row");
            $this->setExcelLeftAlignments($sheet, "E$row");

            if($key == 0) {
                $this->setExcelBold($sheet, "A$row:O$row");
            }

            $number++;
            $row++;
        }
        
        return $spreadsheet;
    }

    public function report(Request $request) {
        $type = $request->type;
        $neighborhoodId = $request->neighborhood_id;
        
        $neighborhood = Neighborhood::find($neighborhoodId);


        if(!$neighborhood) {
            return redirect()->route("web.report_view")->with('error', 'Data RT tidak ada!');
        }

        $results = [];
        $file_name = "LAPORAN PENDUDUK " . $neighborhood->name . " - " . date("d-m-Y");
        $sheet = IOFactory::load(str_replace('/', DIRECTORY_SEPARATOR, storage_path("template") . DIRECTORY_SEPARATOR . "report.xlsx"));

        if(in_array($type, ["population", "men", "women", "children", "birth", "death", "move-in", "move-out"])) {
            $results = Villager::query()
                ->where("neighborhood_id", $neighborhoodId)
                ->when($type != "move-out", function($query) {
                    $query->where("is_move_out", 0);
                })
                ->when($type != "death", function($query) {
                    $query->where("is_death", 0);
                })
                ->when($type == "men", function($query) {
                    $query->where("gender", "L");
                })
                ->when($type == "women", function($query) {
                    $query->where("gender", "P");
                })
                ->when($type == "children", function($query) {
                    $ageLimit = 6;
                    $birthDateLimit = Carbon::now()->subYears($ageLimit)->toDateString();
                    $query->whereDate("birth_date", ">=", $birthDateLimit);
                })
                ->when($type == "birth", function($query) {
                    $query->where("is_birth", 1);
                })
                ->when($type == "death", function($query) {
                    $query->where("is_death", 1);
                })
                ->when($type == "move-in", function($query) {
                    $query->where("is_move_in", 1);
                })
                ->when($type == "move-out", function($query) {
                    $query->where("is_move_out", 1);
                })
                ->get();
        } else {
            return redirect()->route("web.report_view")->with('error', 'Tipe data laporan tidak ada!');
        }
        $file = $type == "population" ? $this->generateReportByFamily($sheet, $results) : $this->generateReportByPerson($sheet, $results);
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx"');
        $writer = new Xlsx($file);
        $writer->save('php://output');
    }
}
