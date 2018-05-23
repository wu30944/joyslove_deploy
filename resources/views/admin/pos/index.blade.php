@extends('admin.layouts.layout')

@section('css')
    <style>
        .animated{-webkit-animation-fill-mode: none;}

        #Content {
            position: absolute;
            left:50%;
        }

    </style>
@endsection

@section('content')

    <div class="row" id="divOrderInfo">
        <div class="col-sm-12">
            {{--<div class="ibox-title">--}}
                {{--<h5>编辑权限</h5>--}}
            {{--</div>--}}
            <div class="ibox-content">
                    <button type="button" class="btn btn-primary btn-lg " onclick="showicon()" value="60" data-info="">
                        <i class="fa fa-plus-circle"></i>@lang('default.order')
                    </button>
                    <a class=" btn btn-warning btn-lg" href="javascript:history.go(-1)"><i class="fa fa-plus-circle"></i>@lang('default.return')</a>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>

            </div>
            <div class="ibox-content">
                <div class="table-responsive text-center">
                    <table class="table table-bordered table-striped scrollable" id="dtOrderInfo" style="font-size: 20px;">
                        <thead>
                            <tr>
                                <th class="text-center">@lang('default.customer_no')</th>
                                <th class="text-center">@lang('default.flavor')</th>
                                <th class="text-center">@lang('default.money')</th>
                                <th class="text-center">@lang('default.action')</th>
                                <th class="text-center">@lang('default.status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dtUserOrder))
                                @foreach($dtUserOrder as $UserOrder)
                                    <tr class="item" id="{{$UserOrder->order_serial_no}}" >
                                            <td>{{$UserOrder->order_serial_no}}</td>
                                            <td>{!! $UserOrder->flavor_name!!}</td>
                                            <td>{{$UserOrder->money}}</td>
                                            <td>
                                                <button type='button' class='btn btn-primary btn-edit' value='{{$UserOrder->order_serial_no}}'>修改</button>
                                            </td>
                                            <td>
                                                <button type='button' class='btn btn-danger btn-processing' value='{{$UserOrder->order_serial_no}}'>@lang('default.processing')</button>
                                                <button type='button' class='btn btn-warning btn-destroy' value='{{$UserOrder->order_serial_no}}'>@lang('default.give_up')</button>
                                            </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="functions" class="hide">
        @include('admin.pos.edit')
    </div>
@endsection
@section('footer-js')
    <script>

        function showicon(){
            $('#divOrderInfo').addClass('hide');
            $('#functions').removeClass('hide');
            $OrderFlavor='';
            $OrderMoney=0;
            $OrderInfo=[];
            $("#Flavor tbody").html("");
            $('#Item').text('尚未選擇項目');
            $('#Number').text('');
//            $('.PressFlavor').removeClass('btn-success');
//            $('.PressFlavor').addClass('btn-default');
            $('.Calculate').removeClass('btn-success');
            $('.Calculate').addClass('btn-default');

            $('html,body').animate({scrollTop:$('#OrderTop').offset().top}, "show");

            window.scrollTo(0, 1);
//            layer.open({
//                type: 1,
//                title:'點餐',
//                area: ['1000px', '120%'], //宽高
//                anim: 2,
//                shadeClose: true, //开启遮罩关闭
//                content: $('#functions')
//            });
        }

        var $OrderFlavor='';
        var $FlavorID='';
        var $OrderNum='';
        var $OrderMoney='';
        var $OrderInfo = [];

        $('.PressFlavorPancake').on('click',function(){
            $OrderFlavor='';
            $OrderMoney='';
            $('.PressFlavorRice').removeClass('btn-default');
            $('.PressFlavorPancake').removeClass('btn-default');
            $('.PressFlavorPancake').addClass('btn-success');
            $(this).addClass('btn-default');

            $OrderFlavor=$(this).text();
            $OrderMoney = $(this).val();
            $FlavorID = $(this).data('info');

            $('#Item').text($OrderFlavor );
            $('#Number').text('*1');

        });

        $('.PressFlavorRice').on('click',function(){
            $OrderFlavor='';
            $OrderMoney='';
            $('.PressFlavorPancake').removeClass('btn-default');
            $('.PressFlavorRice').removeClass('btn-default');
            $('.PressFlavorRice').addClass('btn-info');
            $(this).addClass('btn-default');

            $OrderFlavor=$(this).text();
            $OrderMoney = $(this).val();
            $FlavorID = $(this).data('info');

            $('#Item').text($OrderFlavor );
            $('#Number').text('*1');

        });

        $('.Calculate').on('click',function(){

            $OrderNum = $OrderNum+$(this).val();
            $('#Number').text('*'+$OrderNum);
            $('.Calculate').removeClass('btn-success');
            $('.Calculate').addClass('btn-default');
            $(this).addClass('btn-success');
            $(this).removeClass('btn-default');
        });


        $('.btn-cancel').on('click',function(){

        });

        $('#check').on('click',function(){

            if($OrderFlavor!=""){
                if($OrderNum==""){
                    $OrderNum=1;
                }
                var $Order=[];
                $OrderMoney=$OrderMoney * $OrderNum;

                var trs = $('#Flavor').find('tr').length;
                var $Flag = false;

                for ( i=1; i<trs; i++ ) {
                     $HistoryOrderFlavorId = $('#Flavor').find("tr").eq(i).find("td").eq(4).text().trim();
//                     alert($HistoryOrderFlavorId+'-'+$FlavorID);
//                    alert($('#Flavor').find("tr").eq(i).find("td").eq(1).text()); // 注意-1是因为index从0开始计数
                    if($FlavorID == $HistoryOrderFlavorId)
                    {
                        $HistoryNumber =$('#Flavor').find("tr").eq(i).find("td").eq(1).text();
                        $HistoryMoney =$('#Flavor').find("tr").eq(i).find("td").eq(2).text();
//                        alert(parseInt($HistoryMoney));
                        $('#Flavor').find("tr").eq(i).find("td").eq(1).text(parseInt($OrderNum)+parseInt($HistoryNumber));
                        $('#Flavor').find("tr").eq(i).find("td").eq(2).text(parseInt($OrderMoney)+parseInt($HistoryMoney));

                        $OrderInfo[i-1][2]=parseInt($OrderNum)+parseInt($HistoryNumber);
                        $OrderInfo[i-1][3]=parseInt($OrderMoney)+parseInt($HistoryMoney);

                        $Flag=true;
                        break;
                    }
                }

                if($Flag==false){

                    $Order.push($FlavorID);
                    $Order.push($OrderFlavor);
                    $Order.push($OrderNum);
                    $Order.push($OrderMoney);
                    $OrderInfo.push($Order);

                    $('#Flavor').append("<tr id='Flavor"+trs+"'><td>"+$OrderFlavor+"</td><td align='right'>"+$OrderNum+"</td>" +
                        "<td align='right'>"+$OrderMoney+"</td><td align='left'>" +
                        "<button type='button' class='btn btn-danger item-edit btn-sm' value='"+trs+"'>刪除</button></td>" +
                        "<td style='display:none'>"+$FlavorID+"</td></tr>");
                }


                $('#Item').text('尚未選擇項目');
                $('#Number').text('');

                $('.PressFlavorPancake').addClass('btn-success');
                $('.PressFlavorPancake').removeClass('btn-default');
                $('.PressFlavorRice').addClass('btn-info');
                $('.PressFlavorRice').removeClass('btn-default');

                $('.Calculate').removeClass('btn-success');
                $('.Calculate').addClass('btn-default');

                var scrollHeight = $('#Content').prop("scrollHeight");
                $('#Content').animate({scrollTop:scrollHeight}, 400);


                $OrderFlavor='';
                $OrderNum='';
            }

        });

        $('.btn-finish').on('click',function(){
            $("#Flavor tbody").html("");

//            layer.closeAll();
            $('#divOrderInfo').removeClass('hide');
            $('#functions').addClass('hide');


            if($OrderInfo.length>0)
            {
                $.ajax({
                    type: 'post',
                    url: '{{route('pos.create')}}',//'/admin/MAVersesEdit',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'OrderInfo':$OrderInfo,
                        'OrderSerialNo':$('#order_serial_no').val()
                    },
                    success: function(data) {
//                        $('#dtOrderInfo').load(location.href+" #dtOrderInfo>*","");
//                        alert(data['ResultData']);
                        var $Money=0;
                        var $strFlavor='';

                        for (var i = 0; i < $OrderInfo.length; i++) {
                            if(typeof($OrderInfo[i])!= "undefined"){
                                $strFlavor=$strFlavor+$OrderInfo[i][1]+'*'+$OrderInfo[i][2]+'</br>';
                                $Money = $Money+ $OrderInfo[i][3];
                            }
                        }

                        if($('#order_serial_no').val()==""){
                                                                                                                                                                     {{--<button type='button' class='btn btn-primary btn-edit' value='{{$UserOrder->order_serial_no}}'>修改</button>--}}
                            $('#dtOrderInfo').append("<tr id='"+data['ResultData']+"'><td>"+data['ResultData']+"</td><td>"+$strFlavor+"</td><td>"+$Money+"</td><td><button type='button' class='btn btn-primary btn-edit' value='"+data['ResultData']+"'>修改</button></td><td><button type='button' class='btn btn-danger btn-processing' value='"+data['ResultData']+"'>製作中</button> <button type='button' class='btn btn-warning btn-destroy'  value='"+data['ResultData']+"'>捨棄</button></td></tr>");

                        }else{
                            $strOrderRowId=$('#order_serial_no').val();
                            $("#"+$strOrderRowId).find("td").eq(1).text("").append($strFlavor);
                            $("#"+$strOrderRowId).find("td").eq(2).text($Money);

                        }
                        $OrderInfo=[];
                        $('#order_serial_no').val("");
                        $('.PressFlavorPancake').addClass('btn-success');
                        $('.PressFlavorPancake').removeClass('btn-default');
                        $('.PressFlavorRice').addClass('btn-info');
                        $('.PressFlavorRice').removeClass('btn-default');

                    },error:function(e)
                    {
                        var errors=e.responseJSON;
                        alert(errors.Message);
                    }
                });
            }
        });

        $('.Correction').on('click',function(){
            $OrderNum = $OrderNum.slice(0,$OrderNum.length-1);
            $('#Number').text('*'+$OrderNum);
        });

        $('.Correction').on('dblclick',function(){
            $OrderNum = $OrderNum.slice(0,$OrderNum.length-2);
            $('#Number').text('*'+$OrderNum);
        });


        $(document).on('click', '.btn-destroy', function() {
//            alert($(this).val());
            $Row = "#"+$(this).val();
            $($Row).remove();

            $.ajax({
                type: 'post',
                url: '{{route('pos.DestroyOrder')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'order_serial_no':$(this).val()
                },
                success: function(data) {

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        });

        $(document).on('click', '.btn-processing', function() {

            $Row = "#"+$(this).val();
            $($Row).remove();

            $.ajax({
                type: 'post',
                url: '{{route('pos.UpdateStatus')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'order_serial_no':$(this).val()
                },
                success: function(data) {

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });

        });

        $(document).on('click', '.item-edit', function() {
            $RowId=$(this).val();
            $('#Flavor'+$RowId).remove();

            delete $OrderInfo[$RowId-1];
        });

        $(document).on('click', '.btn-edit', function() {
            $strOrderSerialNo=$(this).val();
            $.ajax({
                type: 'get',
                url: '{{route('pos.OrderDetail')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'order_serial_no':$(this).val()
                },
                success: function(data) {

                    for(i=0;i<data['Data'].length;i++){

                        $('#Flavor').append("<tr id='Flavor"+parseInt(i+1)+"'><td>"+data['Data'][i].flavor_name+"</td><td align='right'>"+data['Data'][i].order_num+"</td>" +
                        "<td align='right'>"+data['Data'][i].money+"</td><td align='left'>" +
                        "<button type='button' class='btn btn-danger item-edit btn-sm' value='"+parseInt(i+1)+"'>刪除</button></td>" +
                        "<td style='display:none'>"+data['Data'][i].flavor_id+"</td></tr>");
                        var $Order=[];
                        $Order.push(data['Data'][i].flavor_id);
                        $Order.push(data['Data'][i].flavor_name);
                        $Order.push(data['Data'][i].order_num);
                        $Order.push(data['Data'][i].money);

                        $OrderInfo.push($Order);
                    }
                    $('#order_serial_no').val($strOrderSerialNo);

//                    layer.open({
//                        type: 1,
//                        title:'點餐',
//                        area: ['1000px', '120%'], //宽高
//                        anim: 2,
//                        shadeClose: true, //开启遮罩关闭
//                        content: $('#functions')
//                    });
                    $('#divOrderInfo').addClass('hide');
                    $('#functions').removeClass('hide');

                    /*下方語法為捲到最下方，新增一筆資料後，就會捲到最下方*/
                    $('html,body').animate({scrollTop:$('#OrderTop').offset().top}, "show");

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });

        });



        // Uses document because document will be topmost level in bubbling
        $(document).on('touchmove',function(e){
            e.preventDefault();
        });

        var scrolling = false;

        // Uses body because jquery on events are called off of the element they are
        // added to, so bubbling would not work if we used document instead.
        $('body').on('touchstart','.scrollable',function(e) {

            // Only execute the below code once at a time
            if (!scrolling) {
                scrolling = true;
                if (e.currentTarget.scrollTop === 0) {
                    e.currentTarget.scrollTop = 1;
                } else if (e.currentTarget.scrollHeight === e.currentTarget.scrollTop + e.currentTarget.offsetHeight) {
                    e.currentTarget.scrollTop -= 1;
                }
                scrolling = false;
            }
        });

        // Prevents preventDefault from being called on document if it sees a scrollable div
        $('body').on('touchmove','.scrollable',function(e) {
            e.stopPropagation();
        });





    </script>
@endsection
