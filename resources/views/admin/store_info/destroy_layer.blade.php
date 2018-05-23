<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>@lang('default.delete')</h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal m-t-md" id="form_destroy">
                <div class="form-group">
                    <div class="col-sm-4">
                     <h3>@lang('message.delete')</h3>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <input type="text" id="destroy_id" name="destroy_id" style="display:none;">
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <div class="col-sm-12" align="right">
                        <button class="btn btn-danger delete" type="submit">
                            <span class='glyphicon glyphicon-trash'></span>&nbsp;@lang('default.delete')
                        </button>

                        {{--<button type="button" class="btn btn-danger delete" id="btn_delete">--}}
                            {{--<span class='glyphicon glyphicon-trash'></span> @lang('default.delete')--}}
                        {{--</button>--}}
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                        </button>
                    </div>
                </div>
                <div class="clearfix"></div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
