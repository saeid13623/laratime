@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="" title="پرداخت های کاربر">تراکنش ها</a></li>
@stop
@section('content')

    <div class="row no-gutters  ">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> کل فروش 30روز گذشته </p>
            <p>{{ number_format($last30DaysTotal) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> درآمدخالص 30روزگذشته</p>
            <p>{{ number_format($totalSiteBenefit) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> کل فروش سایت </p>
            <p>{{ number_format($totalSellerSite) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> درآمد خالص </p>
            <p>{{ number_format($totalSiteBenefit) }} تومان</p>
        </div>
    </div>
        <div class="row  no-gutters font-size-13 margin-bottom-10">
            <div class="col-12 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
                <figure class="highcharts-figure">
                    <div id="container"></div>

                </figure>
            </div>
        </div>
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">  تذاکنش</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ای دی</th>
                        <th> نام و نام خانوادگی</th>
                        <th>ایمیل پرداخت کننده</th>
                        <th>مبلغ</th>
                        <th>درآمدمدرس</th>
                        <th>درآمدسایت</th>
                        <th>نام دوره</th>
                        <th>تاریخ و ساعت</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr role="row" class="" id="trTag">
                            <td>{{$payment->id}}</td>
                            <td>{{$payment->buyer->name}}</td>
                            <td width="80">{{ $payment->buyer->email }}</td>
                            <td width="80">{{ $payment->amount }}</td>
                            <td width="80">{{ $payment->seller_share }}</td>
                            <td width="80">{{ $payment->site_share }}</td>
                            <td width="80">{{ $payment->paymentable->title }}</td>
                            <td width="80">{{ $payment->created_at }}</td>
                            <td width="80" class="@if($payment->status == saeid\Payment\Model\Payment::STATUS_SUCCESS) text-success @else text-error @endif">@lang($payment->status)</td>


                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.chart('container', {
            title: {
                text: 'نمودارفروش'
            },
            xAxis: {
                categories: ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums']
            },
            labels: {
                items: [{
                    html: 'Total fruit consumption',
                    style: {
                        left: '50px',
                        top: '18px',
                        color: ( // theme
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || 'black'
                    }
                }]
            },
            series: [{
                type: 'column',
                name: 'Jane',
                data: [3, 2, 1, 3, 4]
            }, {
                type: 'column',
                name: 'John',
                data: [2, 3, 5, 7, 6]
            }, {
                type: 'column',
                name: 'Joe',
                data: [4, 3, 3, 9, 0]
            }, {
                type: 'spline',
                name: 'Average',
                data: [3, 2.67, 3, 6.33, 3.33],
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[3],
                    fillColor: 'white'
                }
            }, {
                type: 'pie',
                name: 'Total consumption',
                data: [{
                    name: 'Jane',
                    y: 13,
                    color: Highcharts.getOptions().colors[0] // Jane's color
                }, {
                    name: 'John',
                    y: 23,
                    color: Highcharts.getOptions().colors[1] // John's color
                }, {
                    name: 'Joe',
                    y: 19,
                    color: Highcharts.getOptions().colors[2] // Joe's color
                }],
                center: [100, 80],
                size: 100,
                showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }]
        });

    </script>
@endsection
<style>
    .highcharts-figure, .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    #container {
        height: 400px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
