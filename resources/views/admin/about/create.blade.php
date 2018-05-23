<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>@lang('function.create_carousel')</h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal m-t-md" action="{{route('about.create')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.zh_company_name')：</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="zh_company_name" name="zh_company_name" >
                        {{--<select name="is_show" class="form-control">--}}
                            {{--<option value="0" @if(old('is_show') == 0) selected="selected" @endif>@lang('default.show')</option>--}}
                            {{--<option value="1" @if(old('is_show') == 1) selected="selected" @endif>@lang('default.hide')</option>--}}
                        {{--</select>--}}
                        @if ($errors->has('zh_company_name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('zh_company_name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.en_company_name')：</label>
                    <div class="col-sm-3">
                        <input type="text" name="en_company_name" value="{{old('en_company_name')}}" class="form-control" required data-msg-required="請輸入公司名稱(英)">
                        @if ($errors->has('en_company_name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('en_company_name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.address')：</label>
                    <div class="col-sm-3">
                        <input type="text" name="address" value="{{old('address')}}" class="form-control" required data-msg-required="地址">
                        @if ($errors->has('address'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('address')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.fex')：</label>
                    <div class="col-sm-3">
                        <input type="text" name="fex" value="{{old('fex')}}" class="form-control" required data-msg-required="傳真號碼">
                        @if ($errors->has('fex'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('fex')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.telephone')：</label>
                    <div class="col-sm-3">
                        <input type="text" name="telephone" value="{{old('telephone')}}" class="form-control" required data-msg-required="電話號碼">
                        @if ($errors->has('telephone'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('telephone')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.email')：</label>
                    <div class="col-sm-3">
                        <input type="text" name="email" value="{{old('email')}}" class="form-control" required data-msg-required="電話號碼">
                        @if ($errors->has('email'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('email')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('default.uniform_number')：</label>
                    <div class="col-sm-3">
                        <input type="text" name="uniform_number" value="{{old('uniform_number')}}" class="form-control" required data-msg-required="統一編號">
                        @if ($errors->has('uniform_number'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('uniform_number')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;保 存</button>
                        <button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                    </div>
                </div>
                <div class="clearfix"></div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>

