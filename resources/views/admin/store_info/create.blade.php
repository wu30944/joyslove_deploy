@extends('admin.layouts.layout')

@section('css')
    <style>
        .animated{-webkit-animation-fill-mode: none;}
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>建立分店資訊</h5>
            </div>
            <div class="ibox-content">
                <a href="{{route('store_info.index')}}">
                    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> @lang('default.return')
                    </button>
                </a>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form class="form-horizontal m-t-md" action="{{route('store_info.store')}}" method="POST">
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">权限名称：</label>
                        <div class="col-sm-3">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" required data-msg-required="请输入权限名称">
                            @if ($errors->has('name'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-2">
                            <button class="btn btn-primary btn-submit" type="submit"><i class="fa fa-check"></i>&nbsp;保 存</button>
                            <button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
@endsection
{{--@section('footer-js')--}}
    {{--<script>--}}

        {{--$('.form-group').on('click', '.btn-store', function() {--}}

            {{--var i ;--}}
            {{--$.ajax({--}}
                {{--type: 'post',--}}
                {{--url: '{{route('store_info.store')}}',//'/admin/MAVersesEdit',--}}
                {{--data: {--}}
                    {{--'_token': $('input[name=_token]').val(),--}}
                    {{--'id':id,--}}
                    {{--'is_show': '123',--}}
                {{--},--}}
                {{--beforeSend:function(){--}}
                    {{--i = showLoadLayer();--}}
                {{--},--}}
                {{--success: function(data) {--}}
                    {{--if (data['ServerNo']=='404'){--}}
                        {{--$('.error').text(data['ResultData']);--}}
                        {{--$('.error').removeClass('hidden');--}}
                        {{--$('#myModal').modal('show');--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--$('#content'+id).text(data['Data'].content);--}}
                        {{--$('#chapter'+id).text(data['Data'].chapter);--}}
                    {{--}--}}
                {{--},error:function(e)--}}
                {{--{--}}
                    {{--var errors=e.responseJSON;--}}
                    {{--alert(errors.Message);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

    {{--</script>--}}
{{--@endsection--}}
