@extends('joyslove.layout.layout')


@section('content')
<!--Header-->
<div class="header" id="home">
{{--{!! Form::open() !!}--}}
<!--/top-bar-->
    @include('joyslove.commons.navigate')
    <!--//top-bar-->
    <!-- banner-text -->
    <div class="slider">
        <div class="callbacks_container">
            <ul class="rslides callbacks callbacks1" id="slider4">
                @if(count($Banner)>0)
                    @foreach($Banner as $item)
                        <li>
                            <div class="banner-top" style="background-image:url('{{$item->photo_path}}');">
                                <div class="banner-info_agile_w3ls">
                                    <h3>享受美食</h3>
                                    <p>Small change,Big differences.</p>
                                    <a href="#menu" class="scroll">查看菜單 <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                    {{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
                {{--<li>--}}
                    {{--<div class="banner-top" style="background-image:url('/storage/album/主題式全頁相簿/banner1.jpg');">--}}
                        {{--<div class="banner-info_agile_w3ls">--}}
                        {{--<h3>Come hungry. <span>Leave</span> happy.</h3>--}}
                        {{--<p>Small change,Big differences.</p>--}}
                        {{--<a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                        {{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="banner-top1">--}}
                        {{--<div class="banner-info_agile_w3ls">--}}
                            {{--<h3>Better Ingredients. <span> Better</span> Food.</h3>--}}
                            {{--<p>Small change,Big differences.</p>--}}
                            {{--<a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                            {{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="banner-top2">--}}
                        {{--<div class="banner-info_agile_w3ls">--}}
                            {{--<h3>Come hungry. <span>Leave</span> happy.</h3>--}}
                            {{--<p>Small change,Big differences.</p>--}}
                            {{--<a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                            {{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="banner-top3">--}}
                        {{--<div class="banner-info_agile_w3ls">--}}
                            {{--<h3>Better Ingredients. <span> Better</span> Food.</h3>--}}
                            {{--<p>Small change,Big differences.</p>--}}
                            {{--<a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                            {{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</li>--}}
            </ul>
        </div>
        <div class="clearfix"> </div>

        <!--banner Slider starts Here-->
    </div>
    <!-- //Modal1 -->
    <!--//Slider-->
</div>
<!--//Header-->

@include('joyslove.news.news')
@include('joyslove.menu.menu')
@include('joyslove.gallery.gallery')
@include('joyslove.store.store')
@include('joyslove.about.about')
@include('joyslove.contact.contact')


@endsection