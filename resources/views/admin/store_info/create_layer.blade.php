<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>@lang('default.add')</h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal m-t-md" id="form_create">
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.branch_store_name')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_store_name" name="store_name" value="{{old('name')}}" class="form-control" required data-msg-required="{{trans('message.err_flavor_name')}}">
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.post_number')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_local" name="local" value="{{old('name')}}" class="form-control" >
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.telephone')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_telephone" name="telephone" value="{{old('name')}}" class="form-control" >
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.address')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_address" name="address" value="{{old('name')}}" class="form-control" >
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.open_time')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_open_time" name="open_time" value="{{old('name')}}" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.close_time')：</label>
                    <div class="col-sm-4">
                        <input type="text" id="create_close_time" name="close_time" value="{{old('name')}}" class="form-control">
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.is_hide')：</label>
                    <div class="col-sm-2">
                        <select name="is_hidden" class="form-control" id="is_hidden">
                            <option value="0" @if(old('is_hidden') == 0) selected="selected" @endif>@lang('default.show')</option>
                            <option value="1" @if(old('is_hidden') == 1) selected="selected" @endif>@lang('default.hide')</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.status')：</label>
                    <div class="col-sm-2">
                        <select name="status" class="form-control" id="status">
                            <option value="1" @if(old('status') == 1) selected="selected" @endif>启用</option>
                            <option value="0" @if(old('status') == 0) selected="selected" @endif>禁用</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-2">
                        <button class="btn btn-primary btn-store" type="submit"><i class="fa fa-check"></i>&nbsp;@lang('default.store')</button>
                        {{--<button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>--}}
                    </div>
                </div>
                <div class="clearfix"></div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
