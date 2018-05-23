@extends('admin.commons.prompt_layout')

@section('title', '成功提示')

@section('content')
    <div class="sa-icon sa-success animate">
        <span class="sa-line sa-tip animateSuccessTip"></span>
        <span class="sa-line sa-long animateSuccessLong"></span>
        <div class="sa-placeholder"></div>
        <div class="sa-fix"></div>
    </div>
    <h2>{{ $message }}</h2>
    <p>@lang('message.page_auto_transform')：<b id="wait">{{$wait}}</b><a id="href" style="display:none" href="{{$url}}">@lang('message.click_transform')</a></p>
@stop