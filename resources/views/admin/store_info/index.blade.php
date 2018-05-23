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
                <h5>店家資訊</h5>
            </div>
            <div class="ibox-content" id="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">@lang('default.return')</a> &nbsp;

                <button class="btn btn-primary btn-sm" onclick="show()" id="add">
                    <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                </button>
                <a href="{{route('store_info.create')}}" link-url="javascript:void(0)"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 建立分店</button></a>

                <table class="table  table-bordered table-hover m-t-md" id="flavor_content">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('default.store_info')</th>
                        @if(Auth::guard('admin')->user()->hasRule('admin.about.edit'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="page_content" >
                    @if(isset($StoreInfo))
                        @foreach($StoreInfo as $item)
                            <tr class="item{{$item->id}}">
                                <td align="center" style="width:30%;" ><p id = "store_name{{$item->id}}">{{$item->store_name}}</p></td>
                                <td align="center">
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
                                    <a href="{{route('store_info.post_edit',$item['id'])}}">
                                        <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i>POST 修改</button>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    {{--</div>--}}
                    </tbody>
                </table>
                <div class="box-header">
                    <div class="box-tools">
                        @include('admin.commons.pagination')
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

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
        @include('admin.store_info.create_layer')
    </div>

    <div id="edit" style="display: none;">
        @include('admin.store_info.edit')
    </div>

    <div id="destroy" style="display: none;">
        @include('admin.store_info.destroy_layer')
    </div>
@endsection
@section('footer-js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <script>
        var pagination_url = '{{route('store_info.paginate')}}';

        function show(){
//            $("#ibox-content").load(location.href+" #ibox-content>*","");
            {{--window.location.href = "{{route('store_info.post_edit','1')}}";--}}
            layer.open({
                type: 1,
                title:'',
                area: ['600px', '90%'], //宽高
                anim: 2,
                shadeClose: true, //开启遮罩关闭
                content: $('#create')
            });

        }
        $('.fontawesome-icon-list .fa-hover').find('a').click(function(){
            var str=$(this).text();
            $('#fonts').val( $.trim(str));
            layer.closeAll();
        })

        $(document).on('click', '.edit-modal', function() {

            $('#edit_modal input').val('');

            var id =  $(this).data('info');
            NProgress.start();
            $.ajax({
                type: 'get',
                url: '{{route('store_info.edit')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id
                },
                success: function(data) {
//                    $('#id').val(data['Data'].id);
                    $('#edit_id').val(data['id']);
                    $('#edit_store_name').val(data['store_name']);
                    $('#edit_local').val(data['local']);
                    $('#edit_telephone').val(data['telephone']);
                    $('#edit_address').val(data['address']);
                    $('#edit_open_time').val(data['open_time']);
                    $('#edit_close_time').val(data['close_time']);
                    $('#is_hidden').val(data['is_hidden']);
                    $('#status').val(data['status']);


                    layer.open({
                        type: 1,
                        title:'',
                        area: ['600px', '90%'], //宽高
                        anim: 2,
                        shadeClose: true, //开启遮罩关闭
                        content: $('#edit')
                    });

                    NProgress.done();

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });


        });




        $(document).on('click', '.delete-modal', function() {
            $('#destroy_id').val($(this).data('info'));

            layer.open({
                type: 1,
                title:'',
                area: ['700px', '40%'], //宽高
                anim: 2,
                shadeClose: true, //开启遮罩关闭
                content: $('#destroy')
            });
        });


        $().ready(function() {

            $('#form_edit').validate({
                rules: {
                    store_name: {
                        required: true
                    }

                },
                messages: {
                    store_name: '{{trans('message.err_store_name')}}'
                }
                ,
                submitHandler: function(form) {
                    var layer_id ;
                    layer_id = showLoadLayer();
                    NProgress.start();
                    $.ajax({
                        type: 'post',
                        url: '{{route('store_info.update')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id':$('#edit_id').val(),
                            'store_name':$('#edit_store_name').val(),
                            'local':$('#edit_local').val(),
                            'address':$('#edit_address').val(),
                            'open_time':$('#edit_open_time').val(),
                            'close_time':$('#edit_close_time').val(),
                            'is_hidden': $('#is_hidden').val(),
                            'telephone':$('#edit_telephone').val(),
                            'status':$('#status').val(),
                            'page':$('#current_page').val()
                        },
                        success: function(data) {


                            $('.page_content').html(data['page_content']);
                            $('.page').html(data['page']);
                            $('#current_page').val(data['page_num']);
//
                            layer.closeAll();
                            NProgress.done();
                            closeLoadLayer(i);
                        },error:function(e,x,z)
                        {
                            var errors=e.responseJSON;
                            alert(errors.message);

                        }
                    });
                }
            });

            $('#form_create').validate({
                rules: {
                    store_name: {
                        required: true
                    }

                },
                messages: {
                    store_name: '{{trans('message.err_store_name')}}'
                }
                ,
                submitHandler: function(form) {
                    alert($('meta[name="csrf-token"]').attr('content'));
                    NProgress.start();
                    $.ajax({
                        type: 'post',
                        url: '{{route('store_info.storeByAjax')}}',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'store_name':$('#create_store_name').val(),
                            'local':$('#create_local').val(),
                            'address':$('#create_address').val(),
                            'open_time':$('#create_open_time').val(),
                            'close_time':$('#create_close_time').val(),
                            'is_hidden': $('#is_hidden').val(),
                            'telephone':$('#create_telephone').val(),
                            'status':$('#status').val(),
                            'page':$('#current_page').val()
                        },
                        success: function(data) {


                            $('.page_content').html(data['page_content']);
                            $('.page').html(data['page']);
                            $('#current_page').val(data['page_num']);
                            $('#form_create input').val('');
                            layer.closeAll();
                            NProgress.done();
                        },error:function(e,x,z)
                        {
                            var errors=e.responseJSON;
                            alert(errors.message);

                        }
                    });
                }
            });

            $('#form_destroy').validate({
                submitHandler: function(form) {
                    var layer_id ;
                    layer_id = showLoadLayer();
                    NProgress.start();
                    $.ajax({
                        type: 'post',
                        url: '{{route('store_info.destroy')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id':$('#destroy_id').val(),
                            'page':$('#current_page').val()
                        },
                        success: function(data) {

                            $('.page_content').html(data['page_content']);
                            $('.page').html(data['page']);
                            $('#current_page').val(data['page_num']);
//
                            layer.closeAll();
                            NProgress.done();
                            closeLoadLayer(i);
                        },error:function(e,x,z)
                        {
                            var errors=e.responseJSON;
                            alert(errors.message);

                        }
                    });
                }
            });
        });


    </script>
@endsection
