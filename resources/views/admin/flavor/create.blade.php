<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>@lang('default.add')</h5>
        </div>
        <div class="ibox-content">
            {{--<a href="{{route('rules.index')}}">--}}
                {{--<button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 权限管理--}}
                {{--</button>--}}
            {{--</a>--}}
            {{--<div class="hr-line-dashed m-t-sm m-b-sm"></div>--}}
            <form class="form-horizontal m-t-md" id="flavor_create">
                {{--<div class="hr-line-dashed m-t-sm m-b-sm"></div>--}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.flavor_name')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_flavor_name" name="create_flavor_name" value="{{old('name')}}" class="form-control" required data-msg-required="{{trans('message.err_flavor_name')}}">
                        @if ($errors->has('name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.price')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_price" name="create_price" value="{{old('name')}}" class="form-control" required data-msg-required="{{trans('message.err_price')}}">
                        @if ($errors->has('name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.material')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_material" name="create_material" value="{{old('name')}}" class="form-control"  data-msg-required="{{trans('message.err_material')}}">
                        @if ($errors->has('name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.show_name')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_show_name" name="create_show_name" value="{{old('name')}}" class="form-control" required data-msg-required="{{trans('message.err_show_name')}}">
                        @if ($errors->has('name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.status')：</label>
                    <div class="col-sm-2">
                        <select id="create_status" name="create_status" class="form-control">
                            <option value="1" @if(old('status') == 1) selected="selected" @endif>@lang('default.use')</option>
                            <option value="0" @if(old('status') == 0) selected="selected" @endif>@lang('default.not_use')</option>
                        </select>
                        @if ($errors->has('status'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('status')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;@lang('default.store')</button>
                        {{--<button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>--}}
                    </div>
                </div>
                <div class="clearfix"></div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>