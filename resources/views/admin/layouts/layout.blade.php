<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>就是愛POS - @yield('title', config('app.name', '就是愛'))</title>
    <meta name="keywords" content="{{ config('app.name', 'Laravel') }}">
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/favicon.ico">
    <link href="{{loadEdition('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/style.min.css')}}" rel="stylesheet">

    {{--2018/04/21 進度條--}}
    <link href="{{ loadEdition('/admin/css/nprogress.css')}}" rel="stylesheet">

    @yield('css')
</head>
<body class="gray-bg" >
<div class="wrapper wrapper-content animated fadeInRight">
    @include('flash::message')

    <!-- 添加 Pjax 设置：(必须有一个空元素放加载的内容) -->
    <div class="main-content" id="pjax-container">
        @yield('content')
    </div>
</div>
<script src="{{loadEdition('/js/jquery.min.js')}}"></script>
<script src="{{loadEdition('/admin/js/bootstrap.min.js')}}"></script>
@yield('js')


<script src="{{ loadEdition('/admin/js/jquery.pjax.min.js')}}"></script>

{{--201/04/21 進度條--}}
<script src="{{ loadEdition('/admin/js/nprogress.js')}}"></script>



<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

    $(document).pjax('a', '#pjax-container');
    $(document).on("pjax:timeout", function(event) {
        // 阻止超时导致链接跳转事件发生
        event.preventDefault()
    });

    var i ;

    $(document).ready(function()
    {
        NProgress.start();
//        $(document).pjax('a', 'body');
//        var i ;
//
        $(document).on('pjax:start', function() {
            NProgress.start();
            i = showLoadLayer();
        });
//        $(document).on('pjax:end', function() {
//            NProgress.done();
//
//            closeLoadLayer(i);
////            self.siteBootUp();
//        });
    });

    $(window).load(function() {
        NProgress.done();
        closeLoadLayer(i);
    });
    /*
    * 當使用ajax傳送資料到後端，會叫用此function，告訴使用者載入中
    * */
    function showLoadLayer(){
        return layer.msg('{{trans('message.data_loading')}}', {
            icon: 16,
            shade: [0.5, '#f5f5f5'],
            scrollbar: false,
//            offset: '0px',
            time:100000
        }) ;
    }

    /*
    * 當後端資料完成後，回到前端，會將一開始顯示載入中的畫面關閉
    * */
    function closeLoadLayer(index){
        layer.close(index);
    }
//    function ityzl_SHOW_TIP_LAYER(){
//        layer.msg('恭喜您，加载完成！',{time: 1000,offset: '10px'});
//    }

    $(document).on('click', '.btn-submit', function() {
        NProgress.start();
        i=showLoadLayer();
    });

</script>
@yield('footer-js')
</body>
</html>