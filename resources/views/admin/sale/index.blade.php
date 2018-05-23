@extends('admin.layouts.layout')
@section('css')
    <link rel="stylesheet" href="/css/jquery.datetimepicker.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>口味維護</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group row add">
                    <div align="left">
                        <button class="btn btn-primary btn-sm " id="btn-submit" type="button">
                            <span class="glyphicon glyphicon-search"></span> @lang('default.search')
                        </button>
                    </div>
                </div>
                <form class="form-horizontal m-t-md" >
                    <div class="form-group" align="right">
                        <label class="col-sm-2 control-label">@lang('default.branch')：</label>
                        <div class="col-sm-4" align="left">
                            {!! Form::select('store',$StoreName,'',
                                    ['placeholder'=>'所有分店','style'=>'width:200px','id'=>'store']) !!}
                        </div>
                    </div>
                    <div class="form-group" align="right">
                        <label class="col-sm-2 control-label">@lang('default.status')：</label>
                        <div class="col-sm-4" align="left">
                            {!! Form::select('chart_model',$ChartModel,'00008',
                                    ['placeholder'=>'請選擇圖表模式','style'=>'width:200px','id'=>'chart_model']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" id="chart_label">@lang('default.day')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control hide chart" id="chart_year" placeholder="請輸入年度">
                            <input type="text" class="form-control hide chart" id="chart_month" placeholder="請輸入月份">
                            <input type="text" class="form-control chart" id="chart_sday" placeholder="請輸入開始日期">
                            <input type="text" class="form-control chart" id="chart_eday" placeholder="請輸入結束日期">
                            <input type="text" class="form-control hide chart" id="chart_season" placeholder="請輸入第幾季">
                        </div>
                    </div>
                </form>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div id="container" style="min-width:310px;height:400px;margin:0 auto"></div>
            </div>
        </div>
    </div>


@endsection

@section('footer-js')
    <script src="/js/jquery.datetimepicker.full.js"></script>
    <script src="/js/highcharts/highcharts.js"></script>
    <script>

        $(function () {

            $.ajax({
                type: 'get',
                url: '{{route('sale_statistics.statistic_model')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'ChartModel':$('#chart_model').val(),
                    'AdminId': $('#store').val()
                },
                success: function(data) {
                    FlavorName=data['FlavorName'];
                    Data=data['Data'];
                    yAxis = data['yAxis'];
                    xAxis = '口味';
                    strTitle= data['Title'];

                    setChart(FlavorName,Data,strTitle,xAxis,yAxis);
                },error:function(requestObject, error, errorThrown)
                {
                    alert('{{trans('message.error')}}');
                }
            });

        });



        function setChart(FlavorName,Data,strTitle,xAxisTitlec,yAxisTItle){

            var chart = {
                type: 'column'
            };
            var title = {
                text: strTitle
            };
            var subtitle = {
                text: 'Source: runoob.com'
            };
            var xAxis = {
                categories: FlavorName,
                crosshair: true
            };
            var yAxis = {
                min: 0,
                title: {
                    text: yAxisTItle
                }
            };
            var tooltip = {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            };
            var plotOptions = {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            };
            var credits = {
                enabled: false
            };

            var series= [{
                name: xAxisTitlec,
                data: Data
            }];

            var json = {};
            json.chart = chart;
            json.title = title;
            json.subtitle = subtitle;
            json.tooltip = tooltip;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.series = series;
            json.plotOptions = plotOptions;
            json.credits = credits;
            $('#container').highcharts(json);

        }

        $(document).on('click', '#btn-submit', function() {

            var strChartModel = $('#chart_model').val();
            var strDate ;
            var strEDate ;
            var strYear;

            if(strChartModel=='00001' ||strChartModel=='00005'){
                strDate=$('#chart_year').val();
            }else if(strChartModel=='00002' ||strChartModel=='00006'){
                strDate=$('#chart_season').val();
                strYear=$('#chart_year').val();
            }else if(strChartModel=='00003' ||strChartModel=='00007'){
                strDate=$('#chart_month').val();
            }else if(strChartModel=='00004' ||strChartModel=='00008'){
                strDate=$('#chart_sday').val();
                strEDate = $('#chart_eday').val();
            }

            $.ajax({
                type: 'get',
                url: '{{route('sale_statistics.statistic_model')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'ChartModel':$('#chart_model').val(),
                    'Date':strDate,
                    'EDate':strEDate,
                    'Year':strYear,
                    'AdminId': $('#store').val()
                },
                success: function(data) {
                    FlavorName=data['FlavorName'];
                    Data=data['Data'];
                    yAxis = data['yAxis'];
                    xAxis = '口味';
                    strTitle= data['Title'];

                    setChart(FlavorName,Data,strTitle,xAxis,yAxis);
                },error:function(requestObject, error, errorThrown)
                {
                    alert('{{trans('message.error')}}');
                }
            });

        });

        $('#chart_year').datetimepicker({
            yearOffset:0,
            lang:'zh-TW',
            timepicker:false,
            format:'Y',
            formatDate:'Y-m-d'
        });

        $('#chart_month').datetimepicker({
            yearOffset:0,
            lang:'zh-TW',
            timepicker:false,
            format:'Y-m',
            formatDate:'Y-m-d'
        });

        $('#chart_sday').datetimepicker({
            yearOffset:0,
            lang:'zh-TW',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d'
        });
        $('#chart_eday').datetimepicker({
            yearOffset:0,
            lang:'zh-TW',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d'
        });

        $(document).on('change', '#chart_model', function() {
            $('.chart').addClass('hide');
            if($(this).val()=='00001'){
                $('#chart_year').removeClass('hide');
                $('#chart_label').text('年度：');
            }else if($(this).val()=='00002'){
                $('#chart_season').removeClass('hide');
                $('#chart_year').removeClass('hide');
                $('#chart_label').text('季：');
            }else if($(this).val()=='00003'){
                $('#chart_month').removeClass('hide');
                $('#chart_label').text('月份：');
            }else if($(this).val()=='00004'){
                $('#chart_sday').removeClass('hide');
                $('#chart_eday').removeClass('hide');
                $('#chart_label').text('日：');
            }else if($(this).val()=='00005'){
                $('#chart_year').removeClass('hide');
                $('#chart_label').text('年度：');
            }else if($(this).val()=='00006'){
                $('#chart_season').removeClass('hide');
                $('#chart_year').removeClass('hide');
                $('#chart_label').text('季：');
            }else if($(this).val()=='00007'){
                $('#chart_month').removeClass('hide');
                $('#chart_label').text('月份：');
            }else if($(this).val()=='00008'){
                $('#chart_sday').removeClass('hide');
                $('#chart_eday').removeClass('hide');
                $('#chart_label').text('日：');
            }
        });

    </script>
@endsection
