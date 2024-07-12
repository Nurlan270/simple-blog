<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hywax\YaMetrika\Service\ReportService;
use Hywax\YaMetrika\Transformer\ReportDataTransformer;

class DashboardController extends Controller
{
    public function index()
    {
        $reportService = new ReportService([
            'token'             => 'y0_AgAAAAByAWTuAAwRKwAAAAEJyjOcAAArTBS4AyNOCItcpOuWFfOWQ2nzmw',
            'counterId'         => '97773837',
            'resultTransformer' => new ReportDataTransformer(),
        ]);

        //      Geo
        $geo_data = $reportService->getGeo(30, 10000);
        $geo = [];

        foreach ($geo_data['data'] as $value) {
            $geo[$value['dimensions']['regionCountry']['name']] = (int) $value['metrics']['visits'];
        }

        //      Page
        $page_data = $reportService->getMostViewedPages(30, 7);
        $pages = [];

        foreach ($page_data['data'] as $value) {
            $pages[env('APP_URL') . $value['dimensions']['URLPathFull']['name']] = $value['metrics']['pageviews'];
        }

        //      Gender
        $gender_age_data = $reportService->getAgeGender(30, 10000);
        $gender_age = [];

        foreach ($gender_age_data['data'] as $value) {
            $gender_age[ucfirst($value['dimensions']['gender']['id'])] = $value['dimensions']['ageInterval']['id'];
        }

        //      Browser
        $browser_data = $reportService->getBrowsers(30, 10000);
        $browsers = [];

        foreach ($browser_data['data'] as $value) {
            $browsers[$value['dimensions']['browser']['name']] = (int) $value['metrics']['visits'];
        }

        return view('admin.dashboard', compact(['geo', 'pages', 'gender_age', 'browsers']));
    }
}
