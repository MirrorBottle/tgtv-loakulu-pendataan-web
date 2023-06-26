<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Inbox;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Visitor;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";
        $action = 'dashboard_1';

        $today = CarbonImmutable::now();

        $dates = collect(CarbonPeriod::create($today->firstOfMonth(), $today->endOfMonth())->toArray())
            ->map(function($date) {
                return $date->format('d');
            });
        $visitors = Visitor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
            ->whereYear('created_at', $today->format('Y'))
            ->whereMonth('created_at', $today->format('m'))
            ->groupBy('created_at')
            ->orderBy('created_at')
            ->get();
        $tracks = [];
        $curr_month_year = $today->format('Y-m');
        for($day = 0; $day < $today->daysInMonth; $day++) {
            $visitor = $visitors->filter(function($visitor) use ($day, $curr_month_year) {
                return Carbon::parse($visitor->date)->eq(Carbon::parse("$curr_month_year-$day"));
            })->first();
            $tracks[] = $visitor ? $visitor->views : 0;
        }
        $experiences = Experience::all()->count();
        $inboxes = Inbox::all()->count();
        return view('dashboard.index', compact('page_title', 'page_description','action','logo','logoText', 'tracks', 'dates', 'inboxes', 'experiences'));
    }
}
