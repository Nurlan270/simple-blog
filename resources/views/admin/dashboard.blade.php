@extends('layouts.admin')

@section('page.title', 'Dashboard')

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
                <div class="box-content" style="overflow: hidden; width: auto; height: 340px;">
                    <div class="text-center fw-bold">Top Referring Sites</div>
                    <div class="row mb-2">
                        <div class="col-md-10">Link</div>
                        <div class="col">Views</div>
                    </div>
                    <hr class="my-0">
                    <table style="margin: 20px 5px">
                        <tbody>
                        <tr>
                            <td><i class="fa fa-link"></i></td>
                            <td style="width: 100%; text-align: left; padding-right: 20px" class="ellipsis"><a
                                    href="https://preview.keenthemes.com/" rel="nofollow" style="color: #444">https://preview.keenthemes.com/</a>
                            </td>
                            <td style="text-align: right; padding-right: 0">3</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-link"></i></td>
                            <td style="width: 100%; text-align: left; padding-right: 20px" class="ellipsis"><a
                                    href="https://github.com/" rel="nofollow"
                                    style="color: #444">https://github.com/</a></td>
                            <td style="text-align: right; padding-right: 0">1</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-link"></i></td>
                            <td style="width: 100%; text-align: left; padding-right: 20px" class="ellipsis"><a
                                    href="https://wooncloud.tistory.com/" rel="nofollow" style="color: #444">https://wooncloud.tistory.com/</a>
                            </td>
                            <td style="text-align: right; padding-right: 0">1</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-link"></i></td>
                            <td style="width: 100%; text-align: left; padding-right: 20px" class="ellipsis"><a
                                    href="https://gist.github.com/" rel="nofollow" style="color: #444">https://gist.github.com/</a>
                            </td>
                            <td style="text-align: right; padding-right: 0">1</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
