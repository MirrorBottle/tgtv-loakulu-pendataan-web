<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebInboxRequest;
use App\Models\Experience;
use App\Models\Family;
use App\Models\Gallery;
use App\Models\Inbox;
use App\Models\Mission;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Villager;
use App\Models\Visitor;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Artesaos\SEOTools\Facades\SEOTools;


use PhpOffice\PhpSpreadsheet\IOFactory;

class WebController extends Controller
{
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
        $neighborhood_id = 7;

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
                    "family_id"       => $sheet->getCell("D$row")->getValue(),
                    "birth_place"     => $births[0],
                    "birth_date"      => Carbon::createFromFormat("d-m-Y", str_replace(' ', '', $births[1]))->format("Y-m-d"),
                    "religion"        => preg_replace('/\s+/','',$sheet->getCell("F$row")->getValue()),
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
                dd($e->getMessage());
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
}
