@extends('admin.commons.prompt_layout')

@section('title', '錯誤提示')

@section('content')
<div class="sa-icon sa-error">
        <span class="sa-x-mark animateXMark">
            <span class="sa-line sa-left"></span>
            <span class="sa-line sa-right"></span>
        </span>
</div>
    <h2>{{ $message }}</h2>
    <p>@lang('message.error_back')：<b id="wait">{{$wait}}</b>
        <a id="href" style="display:none" href="{{$url}}">
            @lang('message.click_back')
        </a>
    </p>
@stop