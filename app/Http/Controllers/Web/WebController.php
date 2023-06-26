<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebInboxRequest;
use App\Models\Experience;
use App\Models\Gallery;
use App\Models\Inbox;
use App\Models\Mission;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Visitor;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Artesaos\SEOTools\Facades\SEOTools;

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

    public function inbox(WebInboxRequest $request) {
        $inbox = Inbox::create($request->all());
        return redirect()->back()->with('status',"Terima kasih, pesan anda berhasil kami terima!");
    }
}
