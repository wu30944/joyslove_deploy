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
                <h5>口味維護</h5>
            </div>
            <div class="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">@lang('default.return')</a> &nbsp;
                {{--@if(Auth::guard('admin')->user()->hasRule('admin.flavor.add'))--}}
                    {{--<div class="form-group row add">--}}
                        {{--<br>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<button class="btn btn-primary btn-sm" type="submit" id="add">--}}
                                {{--<span class="glyphicon glyphicon-plus"></span> @lang('default.add')--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
                <button class="btn btn-primary btn-sm" onclick="showicon()" id="add">
                    <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                </button>

                <table class="table  table-bordered table-hover m-t-md" id="flavor_content">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('default.flavor_name')</th>
                        <th class="text-center">@lang('default.money')</th>
                        <th class="text-center">@lang('default.status')</th>
                        @if(Auth::guard('admin')->user()->hasRule('admin.flavor.edit'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="page_content" >
                        {{--<div class="page_content">--}}
                            @if(isset($dtFlavor))
                                @foreach($dtFlavor as $item)
                                    <tr class="item{{$item->id}}">
                                        <td align="left" style="width:20%"><p id = "flavor_name{{$item->id}}">{{$item->flavor_name}}</p></td>
                                        <td align="left" style="width:10%"><p id = "money{{$item->id}}">{{$item->money}}</p></td>
                                        <td align="left" style="width:10%"><p id = "status{{$item->id}}">{{$item->status}}</p></td>
                                        <td style="width:10%" align="center">
                                            @if(Auth::guard('admin')->user()->hasRule('admin.flavor.edit'))
                                                <button class="edit-modal btn btn-info"
                                                        data-info="{{$item->id}}">
                                                    <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                                                </button>
                                            @endif
                                            @if(Auth::guard('admin')->user()->hasRule('admin.flavor.destroy'))
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
        <div id="myModal" class="modal fade" role="dialog">
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
                                <label class="control-label col-sm-2" for="flavor_name">@lang('default.flavor_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="flavor_name" name="flavor_name" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="price">@lang('default.price'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="price" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="material">@lang('default.material'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="material" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="material">@lang('default.show_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="para_1" >
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
    <div id="functions" style="display: none;">
        @include('admin.flavor.create')
    </div>
@endsection
@section('footer-js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <script>
        var pagination_url = '{{route('flavor.paginate')}}';

        function showicon(){
//            alert($('#current_page').val());
            layer.open({
                type: 1,
                title: '新增口味',//'{{trans('default.add')}}',
                area: ['600px', '100%'], //宽高
                anim: 2,
                shadeClose: true, //开启遮罩关闭
                content: $('#functions')
            });
        }
        $('.fontawesome-icon-list .fa-hover').find('a').click(function(){
            var str=$(this).text();
            $('#fonts').val( $.trim(str));
            layer.closeAll();
        })

        $(document).on('click', '.edit-modal', function() {

            $('#myModal input').val('');

            var id =  $(this).data('info');
            layer.msg('{{trans('message.data_loading')}}', {
                icon: 16,
                time: 1500,
                shade: 0.01
            });
            $.ajax({
                type: 'post',
                url: '{{route('flavor.edit')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id
                },
                success: function(data) {
                   $('#id').val(data['Data'].id);
                   $('#flavor_name').val(data['Data'].flavor_name);
                   $('#price').val(data['Data'].money);
                   $('#material').val(data['Data'].material);
                   $('#para_1').val(data['Data'].para_1);

                   if(data['Data'].status==1){
                        $("#status").val(1);
                    }else{
                       $("#status").val(0);
                    }

                    $('#myModal').modal('show');

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
            // alert('test');
            $.ajax({
                type: 'post',
                url: '',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'content': $("#AddContent").val(),
                    'chapter': $('#AddChapter').val()
                },
                success: function(data) {
                    if (data['ServerNo']=='404'){
                        $('.error').text(data['ResultData']);
                        $('.error').removeClass('hidden');
                        $('#AddModel').modal('show');
                    }
                    else {
                        alert(data['ResultData']);
                        location.reload();
                    }
                },error:function(e){
                    var errors = e.responseJSON;
                }

            });

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

//        $('.modal-footer').on('click', '.delete', function() {
//            $.ajax({
//                type: 'post',
//                url: '',//'/admin/MAVersesDelete',
//                data: {
//                    '_token': $('input[name=_token]').val(),
//                    'id': $('#id').val()
//                },
//                success: function(data) {
//                    $('.item' + $('#id').val()).remove();
//                }
//            });
//        });

        $().ready(function() {

            $("#form_edit").validate({
                rules: {
                    flavor_name: {
                        required: true
                    }
                },
                messages: {
                    flavor_name: "請輸入口味名稱"

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
                        url: '{{route('flavor.store')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id':id,
                            'flavor_name':$('#flavor_name').val(),
                            'money':$('#price').val(),
                            'material':$('#material').val(),
                            'para_1':$('#para_1').val(),
                            'status':$('#status').val()
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

            $('#flavor_create').validate({
                rules: {
                    create_flavor_name: {
                        required: true
                    },
                    create_price:{
                        required: true,
                        number: true

                    },
                    create_show_name:{
                        required:true
                    },
                    create_status:{
                        required:true
                    }

                },
                messages: {
                    create_flavor_name: '{{trans('message.err_flavor_name')}}',
                    create_price:{requried:'{{trans('message.err_price')}}',number:'{{trans('message.err_number')}}'},
                    create_show_name:'{{trans('message.err_show_name')}}',
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
                        url: '{{route('flavor.create')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'flavor_name':$('#create_flavor_name').val(),
                            'money':$('#create_price').val(),
                            'material':$('#create_material').val(),
                            'para_1':$('#create_show_name').val(),
                            'status':$('#create_status').val(),
                            'page':$('#current_page').val()
                        },
                        success: function(data) {
                            $('.page_content').html(data['page_content']);
                            $('.page').html(data['page']);
                            $('#current_page').val(page);
                            $('#flavor_create').find("input[type=text], textarea").val("");

                            alert('{{trans('message.store_successful')}}');
                            layer.closeAll();

                        },error:function(requestObject, error, errorThrown)
                        {
                            alert('{{trans('message.error')}}');
                        }
                    });
                }
            });
        });

//        $(document).on('click', '#flavor_content', function(e){
////            alert(e.target.row);
//            $strRow = $(e.target).closest("tr").index()+1;
//            $('#flavor_content').css('background-color','#ffffff');
//            $('#flavor_content').find("tr").eq($strRow).css('background-color','#ffea62');
//
////            $(e.target).parent('tr').css('background-color','#ffea62');
//        });

    </script>
@endsection
