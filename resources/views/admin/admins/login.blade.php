<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{config('app.title')}} - {{ config('app.name', '就是愛後台管理系統') }}</title>
    <meta name="keywords" content="後台登入">
    <meta name="description" content="後台登入">
    <link href="{{loadEdition('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/style.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/login.min.css')}}" rel="stylesheet">
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-5 animated fadeInLeft">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        @include('flash::message')
                        <h1>{{ config('app.name', 'Laravel') }}</h1>
                    </div>
                    <div class="m-b"></div>
                    <h4>@lang('default.welcome_use') <span class="label label-info">{{ config('app.name', 'Laravel') }}</span></h4>
                    <ul class="m-b">
                        <li><i class="fa fa-circle text-navy"></i> 优势一：采用Laravel 5.5 框架开发</li>
                        <li><i class="fa fa-circle text-navy"></i> 优势二：采用最流行的前端技术</li>
                        <li><i class="fa fa-circle text-navy"></i> 优势三：极佳的用户操作体验和安全策略</li>
                        <li><i class="fa fa-circle text-navy"></i> 优势四：MVC分层模式，应用模块化</li>
                        <li><i class="fa fa-circle text-navy"></i> 优势五：最大亮点是对接公众平台</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-7 animated fadeInRight">
                <form method="post" action="{{route('login-handle')}}">
                    {{csrf_field()}}
                    <p class="login-title">@lang('default.login')</p>
                    <p class="m-t-md" style="color:#666">@lang('default.login'){{ config('app.name', 'Laravel') }}後台管理</p>
                    <input type="text" class="form-control uname" name="name" value="{{old('name')}}" required placeholder="{{trans('default.account')}}" />
                    <input type="password" class="form-control pword m-b" name="password" required placeholder="{{trans('default.password')}}" />
                    {{--<div style="width: 300px;">--}}
                        {{--{!! Geetest::render() !!}--}}
                    {{--</div>--}}
                    <p></p>
                    <button class="btn btn-success btn-block">@lang('default.login')</button>
                    <p></p>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <h4>有錯誤發生：</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="signup-footer animated fadeInUp">
            &copy; 2018 All Rights Reserved. {{ config('app.name', 'Laravel') }}
        </div>
    </div>
</body>
</html>
