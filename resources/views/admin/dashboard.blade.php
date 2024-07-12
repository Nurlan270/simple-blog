@extends('layouts.admin')

@section('page.title', 'Dashboard')

@pushonce('css')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        const geo = <?= json_encode($geo) ?>;
        const gender_age = <?= json_encode($gender_age) ?>;
        const browsers = <?= json_encode($browsers) ?>;

        google.charts.load("current", {packages: ["corechart"]});

        google.charts.setOnLoadCallback(drawGeoChart);
        google.charts.setOnLoadCallback(drawGenderChart);
        google.charts.setOnLoadCallback(drawBrowserChart);


        function drawGeoChart() {
            var dataArray = [['Country', 'Views']];
            for (const [country, views] of Object.entries(geo)) {
                dataArray.push([country, views]);
            }

            var data = google.visualization.arrayToDataTable(dataArray);

            var options = {
                title: 'Visits from countries in 30 days',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('geo_chart'));
            chart.draw(data, options);
        }

        function drawGenderChart() {
            var dataArray = [['Gender', 'Age']];
            for (const [gender, age] of Object.entries(gender_age)) {
                dataArray.push([gender, age]);
            }
            var data = google.visualization.arrayToDataTable(dataArray);

            var options = {
                title: 'Gender and age',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('gender_age_chart'));
            chart.draw(data, options);
        }

        function drawBrowserChart() {
            var dataArray = [['Browser', 'Visits']];
            for (const [browser, visits] of Object.entries(browsers)) {
                dataArray.push([browser, visits]);
            }
            var data = google.visualization.arrayToDataTable(dataArray);

            var options = {
                title: 'Browsers and visits',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('browsers_chart'));
            chart.draw(data, options);
        }
    </script>
@endpushonce

@section('content')

    <h1>Dashboard Panel</h1>
    <hr>

    <div class="row">
        <div class="col-md-3">
            <div class="card p-4 mb-3">
                <div class="box-content" style="overflow: hidden; width: auto; height: 160px;">
                    <span class="time h1">{{ now()->format('H:i') }}<small
                            style="font-size: 50%">{{ now()->format('A') }}</small></span>
                    <br><br>
                    <span class="date h5 text-muted">{{ now()->format('l / F jS / Y') }}</span>
                    <br><br>
                    <span class="h5 text-muted">{{ now()->getTimezone() }}</span>
                </div>
                <hr class="my-0">
                <div class="text-center mt-3 fw-bold">Today</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card p-3 mb-3">
                <div class="box-content" style="overflow: hidden; width: auto; height: 270px;">
                    <div class="text-center fw-bold">Most viewed pages</div>
                    <div class="row mb-2">
                        <div class="col-md-10">Link</div>
                        <div class="col">Views</div>
                    </div>
                    <hr class="my-0">
                    <table style="margin: 20px 5px">
                        <tbody>
                        @foreach($pages as $url => $views)
                            <tr>
                                <td><i class="fa fa-link"></i></td>
                                <td style="width: 100%; text-align: left; padding-right: 20px" class="ellipsis">
                                    <a href="{{ $url }}" rel="nofollow" style="color: #444">{{ $url }}</a>
                                </td>
                                <td style="text-align: right; padding-right: 0">{{ $views }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="geo_chart" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div id="gender_age_chart" style="width: 100%; height: 300px;"></div>
        </div>
        <div class="col-md-6">
            <div id="browsers_chart" style="width: 100%; height: 300px;"></div>
        </div>
    </div>

@endsection
