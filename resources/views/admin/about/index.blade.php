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
                <h5>關於我們</h5>
            </div>
            <div class="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">@lang('default.return')</a> &nbsp;
                <button class="btn btn-primary btn-sm" onclick="show()" id="add">
                    <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                </button>

                <table class="table  table-bordered table-hover m-t-md" id="flavor_content">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('default.company_name')</th>
                        @if(Auth::guard('admin')->user()->hasRule('admin.about.edit'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="page_content" >
                        {{--<div class="page_content">--}}
                            @if(isset($About))
                                @foreach($About as $item)
                                    <tr class="item{{$item->id}}">
                                        <td align="left" style="width:20%"><p id = "company_name{{$item->id}}">{{$item->zh_company_name}}</p></td>
                                        <td style="width:10%" align="center">
                                            @if(Auth::guard('admin')->user()->hasRule('admin.about.edit'))
                                                <button class="edit-modal btn btn-info"
                                                        data-info="{{$item->id}}">
                                                    <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                                                </button>
                                            @endif
                                            @if(Auth::guard('admin')->user()->hasRule('admin.about.destroy'))
                                                <button class="delete-modal btn btn-danger"
                                                        data-info="{{$item->id}}">
                                                    <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                                                </button>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        {{--</div>--}}
                    </tbody>
                </table>
                <div class="box-header">
                    <div class="box-tools">
                        {{--{{$dtFlavor->links()}}--}}
                        @include('admin.commons.pagination')
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="edit_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">@lang('default.edit')</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" id="form_edit" >
                            <div class="form-group hidden">
                                <label class="control-label col-sm-2 " for="id">id:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_zh_company_name">@lang('default.zh_company_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_zh_company_name" name="edit_zh_company_name" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_en_company_name">@lang('default.en_company_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_en_company_name" name="edit_en_company_name" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_address">@lang('default.address'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_address"  name="edit_address">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_fex">@lang('default.fex'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_fex" name="edit_fex">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_telephone">@lang('default.telephone'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_telephone" name="edit_telephone">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_email">@lang('default.email'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_email" name="edit_email">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_uniform_number">@lang('default.uniform_number'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_uniform_number" name="edit_uniform_number">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_zh_introduction">@lang('default.zh_introduction'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_zh_introduction" name="edit_zh_introduction">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_en_introduction">@lang('default.en_introduction'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_en_introduction" name="edit_en_introduction">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">@lang('default.status')：</label>
                                <div class="col-sm-2">
                                    <select name="status" class="form-control" id="status">
                                        <option value="1" >@lang('default.use')</option>
                                        <option value="0" >@lang('default.not_use')</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('status')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer">
                                <p class="error text-center alert alert-danger hidden"></p>

                                <button type="submit" class="btn btn-store btn-success" id="editbtn" >
                                    <span id="footer_action_button" class='glyphicon glyphicon-ok'> </span> @lang('default.store')
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="DeleteModel" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">@lang('default.delete')</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group hidden">
                                <label class="control-label col-sm-2 " for="delete_id">id:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="delete_id" disabled>
                                </div>
                            </div>
                        </form>
                        <div class="deleteContent">
                            @lang('message.delete') <span class="dname"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class="btn btn-danger delete" id="btn_delete">
                                <span class='glyphicon glyphicon-trash'></span> @lang('default.delete')
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" class="form-control" id="current_page" disabled value="" style="display:none;">
    </div>
    <div id="create" style="display: none;">
        @include('admin.about.create')
    </div>
@endsection
@section('footer-js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <script>
        var pagination_url = '{{route('flavor.paginate')}}';

        function show(){
            layer.open({
                type: 1,
                title:'',
                area: ['600px', '80%'], //宽高
                anim: 2,
                shadeClose: true, //开启遮罩关闭
                content: $('#create')
            });
            //$('#create_modal').modal('show');
        }
        $('.fontawesome-icon-list .fa-hover').find('a').click(function(){
            var str=$(this).text();
            $('#fonts').val( $.trim(str));
            layer.closeAll();
        })

        $(document).on('click', '.edit-modal', function() {

            $('#edit_modal input').val('');

            var id =  $(this).data('info');
            layer.msg('{{trans('message.data_loading')}}', {
                icon: 16,
                time: 1500,
                shade: 0.01
            });
            $.ajax({
                type: 'get',
                url: '{{route('about.edit')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id
                },
                success: function(data) {
                   $('#id').val(data['Data'].id);
                    $('#edit_zh_company_name').val(data['Data'].zh_company_name);
                    $('#edit_en_company_name').val(data['Data'].en_company_name);
                    $('#edit_address').val(data['Data'].address);
                    $('#edit_telephone').val(data['Data'].telephone);
                    $('#edit_zh_introduction').val(data['Data'].zh_introduction);
                    $('#edit_en_introduction').val(data['Data'].en_introduction);
                    $('#edit_email').val(data['Data'].email);
                    $('#edit_status').val(data['Data'].status);
                    $('#edit_uniform_number').val(data['Data'].uniform_number);
                    $('#edit_fex').val(data['Data'].fex);

                   if(data['Data'].status==1){
                        $("#edit_status").val(1);
                    }else{
                       $("#edit_status").val(0);
                    }

                    $('#edit_modal').modal('show');

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });


        });

        $('.modal-footer').on('click', '.edit', function() {

            $.ajax({
                type: 'post',
                url: '',//'/admin/MAVersesEdit',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id,
                    'is_show': is_show,
                    'content': content,
                    'chapter': chapter,
                    'status':status
                },
                success: function(data) {
                    if (data['ServerNo']=='404'){
//                    alert(data['Result']);
                        $('.error').text(data['ResultData']);
                        $('.error').removeClass('hidden');
                        $('#myModal').modal('show');
                    }
                    else {
                        $('#content'+id).text(data['Data'].content);
                        $('#chapter'+id).text(data['Data'].chapter);
                    }
                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        });


        /*
            當按下新增按鈕時，會去做的事情
        */
        $(document).on('click', '.btn-primary', function() {
        });

        /*
            當按下儲存時，會去做的事情
        */
        $(document).on('click', '.btn-store', function() {
//            alert('test');
        });

        $("#addbtn").click(function() {

        });


        $(document).on('click', '#btn_delete', function() {
            var id = $('#delete_id').val();
            $('#delete_id').val('');
            layer.msg('{{trans('message.data_destroy')}}', {
                icon: 16,
                time: 1500,
                shade: 0.01
            });
            $.ajax({
                type: 'post',
                url: '{{route('flavor.destroy')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id,
                    'page':$('#current_page').val()
                },
                success: function(data) {

                    $('.page_content').html(data['page_content']);
                    $('.page').html(data['page']);
                    $('#current_page').val(page);

                    $('#DeleteModel').modal('hide');
                    alert('{{trans('message.destroy_successful')}}')

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        });


        $(document).on('click', '.delete-modal', function() {
            $('#delete_id').val($(this).data('info'));
            $('#DeleteModel').modal('show');
        });


        $().ready(function() {

            $("#form_edit").validate({
                rules: {
                    edit_zh_company_name: {
                        required: true
                    },
                    edit_address:{
                        required: true
                    },
                    edit_telephone:{
                        required:true
                    },
                    edit_zh_introduction:{
                        required:true
                    },
                    edit_email:{
                        required:true
                    },
                    edit_status:{
                        required:true
                    }

                },
                messages: {
                    edit_zh_company_name: '{{trans('message.err_zh_company_name')}}',
                    edit_address:{requried:'{{trans('message.err_address')}}'},
                    edit_telephone:'{{trans('message.err_telephone')}}',
                    edit_zh_introduction:'{{trans('message.err_zh_introduction')}}',
                    edit_email:'{{trans('message.err_email')}}',
                    edit_status:'{{trans('message.err_status')}}'
                },
                submitHandler: function(form) {
                    layer.msg('{{trans('message.data_submit')}}', {
                        icon: 16,
                        time: 1500,
                        shade: 0.01
                    });
                    var id=$('#id').val();
                    $.ajax({
                        type: 'post',
                        url: '{{route('about.store')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'zh_company_name':$('#edit_zh_company_name').val(),
                            'en_company_name':$('#edit_en_company_name').val(),
                            'address':$('#edit_address').val(),
                            'telephone':$('#edit_telephone').val(),
                            'zh_introduction':$('#edit_zh_introduction').val(),
                            'en_introduction':$('#edit_en_introduction').val(),
                            'email':$('#edit_email').val(),
                            'status':$('#edit_status').val(),
                            'uniform_number':$('#edit_uniform_number').val(),
                            'fex':$('#edit_fex').val(),
                            'page':$('#current_page').val()
                        },
                        success: function(data) {
                            $('#flavor_name'+id).text($('#flavor_name').val());
                            $('#money'+id).text($('#price').val());
                            $('#status'+id).text($('#status').val());
                            alert('{{trans('message.store_successful')}}');
                            $('#myModal').modal('hide');

                        },error:function(requestObject, error, errorThrown)
                        {
                            alert('{{trans('message.error')}}');
                        }
                    });
                }
            });

            $('#form_create').validate({
                rules: {
                    create_zh_company_name: {
                        required: true
                    },
                    create_address:{
                        required: true
                    },
                    create_telephone:{
                        required:true
                    },
                    create_zh_introduction:{
                        required:true
                    },
                    create_email:{
                        required:true
                    },
                    create_status:{
                        required:true
                    }

                },
                messages: {
                    create_zh_company_name: '{{trans('message.err_zh_company_name')}}',
                    create_address:{requried:'{{trans('message.err_address')}}'},
                    create_telephone:'{{trans('message.err_telephone')}}',
                    create_zh_introduction:'{{trans('message.err_zh_introduction')}}',
                    create_email:'{{trans('message.err_email')}}',
                    create_status:'{{trans('message.err_status')}}'
                }
                ,
                submitHandler: function(form) {
                    layer.msg('{{trans('message.data_submit')}}', {
                        icon: 16,
                        time: 1500,
                        shade: 0.01
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{route('about.create')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'zh_company_name':$('#create_zh_company_name').val(),
                            'en_company_name':$('#create_en_company_name').val(),
                            'address':$('#create_address').val(),
                            'telephone':$('#create_telephone').val(),
                            'zh_introduction':$('#create_zh_introduction').val(),
                            'en_introduction':$('#create_en_introduction').val(),
                            'email':$('#create_email').val(),
                            'status':$('#create_status').val(),
                            'uniform_number':$('#create_uniform_number').val(),
                            'fex':$('#create_fex').val(),
                            'page':$('#current_page').val()
                        },
                        success: function(data) {
                            $('.page_content').html(data['page_content']);
                            $('.page').html(data['page']);
//                            $('#current_page').val(page);
                            $('#form_create').find("input[type=text], textarea").val("").modal('hide');

                            alert('{{trans('message.store_successful')}}');

                        },error:function(requestObject, error, errorThrown)
                        {
                            alert('{{trans('message.error')}}');
                        }
                    });
                }
            });
        });


    </script>
@endsection
