@inject('NavigateService', 'App\Services\NavigateService')
<!--/top-bar-->
<div class="top-bar">
    <div class="header-top_w3layouts">
        <div class="forms">
            <p><span class="fa fa-map-marker" aria-hidden="true"></span>{{$About['address']}}</p>
            <p><span class="fa fa-envelope-o" aria-hidden="true"></span> <a href="mailto:info@example.com">{{$About['email']}}</a></p>
        </div>
        <ul class="top-right-info">
            <li><a href="https://www.facebook.com/%E5%85%89%E8%8F%AF%E7%85%8E%E9%A4%85%E6%9E%9C%E5%AD%90-324011711434356/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

        </ul>
        <div class="search">
            <div class="cd-main-header">
                <ul class="cd-header-buttons">
                    <li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
                </ul>
                <!-- cd-header-buttons -->
            </div>
            <div id="cd-search" class="cd-search">
                <form action="#" method="post">
                    <input name="Search" type="search" placeholder="Click enter after typing...">
                </form>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
    <div class="header-nav">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1><a class="navbar-brand" href="index.html"><span>就是愛</span></a></h1>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                <nav>
                    <ul class="top_nav">
                        @foreach($NavigateService->getNavigateTree() as $key => $rule)

                            @if(isset($rule['children']))
                                @foreach($rule['children'] as $k=>$item)
                                    <li><a class="scroll" href="{{$item['route']}}">{{$item['name']}}</a></li>
                                @endforeach
                            @endif
                        @endforeach
                        {{--<li><a class="scroll" href="#home" class="active">首頁</a></li>--}}
                        {{--<li><a class="scroll" href="#about">關於就是愛</a></li>--}}
                        {{--<li><a class="scroll" href="#choose">最新消息</a></li>--}}
                        {{--<li><a class="scroll" href="#menu">就是愛 MENU</a></li>--}}
                        {{--<!--<li><a class="scroll" href="#services">營業時間</a></li>-->--}}
                        {{--<li class="dropdown menu__item">--}}
                        {{--<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" data-hover="Pages" role="button" aria-haspopup="true"--}}
                        {{--aria-expanded="false">Drop Down <span class="fa fa-angle-down"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                        {{--<li><a class="scroll" href="#menu">就是愛 MENU</a></li>--}}
                        {{--<li><a class="scroll" href="#book">Booking</a></li>--}}
                        {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li><a class="scroll" href="#gallery">就是愛特色</a></li>--}}
                        {{--<li><a class="scroll" href="#client">尋找就是愛</a></li>--}}
                        {{--<li><a class="scroll" href="#mail">與我們聯絡</a></li>--}}
                    </ul>
                </nav>
            </div>
        </nav>

    </div>
</div>
<!--//top-bar-->