@extends('admin.layouts.layout')

@section('css')
    <style>
        .animated{-webkit-animation-fill-mode: none;}
        .table-borderless tbody tr td, .table-borderless tbody tr th,
        .table-borderless thead tr th {
            border: none;
        }
    </style>
@endsection
@section('content')
        <div class="content full ibox-content">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @elseif($message = Session::get('fails'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>

            @endif

            @if(Auth::guard('admin')->user()->hasRule('album.edit'))
                <div class="form-group row add">
                    <br>

                    <div class="col-md-4">
                        <button class="btn btn-info" id="add">
                            <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                        </button>
                    </div>
                </div>
            @endif

            {{ csrf_field() }}
            <div class="table-responsive text-center">
                <table class="table table-borderless table-striped" id="gridview">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('default.album_name')</th>
                        <th class="text-center">@lang('default.status')</th>
                        <th class="text-center">@lang('default.create_time')</th>
                        @if(Auth::guard('admin')->user()->hasRule('album.edit'))
                            <th class="text-center">@lang('default.action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="page_content">
                        @foreach($Album as $item)
                            <tr class="item{{$item->id}}">
                                <td align="center" style="width:20%"><p id = "album_name{{$item->id}}">{{$item->album_name}}</p></td>
                                <td align="center" style="width:20%" class="hide"><p id = "album_type{{$item->id}}">{{$item->album_type}}</p></td>
                                <td align="center" style="width:20%"><p id = "status{{$item->id}}">{{$item->status}}</p></td>
                                <td align="center" style="width:20%"><p id = "created_at{{$item->id}}">{{$item->created_at}}</p></td>
                                <td align="center" style="width:20%">
                                    @if(Auth::guard('admin')->user()->hasRule('album.edit'))
                                        {{--<a href="{{route('album.edit',$item->album_name)}}" style="color:white">--}}
                                            <button class="edit-modal btn btn-success"
                                                data-info="{{$item->id}}">
                                            <span class="glyphicon glyphicon-edit"></span>

                                                    @lang('default.edit')

                                             </button>
                                        {{--</a>--}}
                                    @endif
                                    @if(Auth::guard('admin')->user()->hasRule('album.destroy_album'))
                                        <button class="delete-modal btn btn-danger"
                                                data-info="{{$item->id}}">
                                            <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                                        </button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
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
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group hidden">
                                <label class="control-label col-sm-2 " for="id">id:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="Content">@lang('default.verses'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Content" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="Chapter">@lang('default.chapter'):</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="Chapter">
                                </div>
                            </div>
                        </form>
                        <div class="deleteContent">
                            Are you Sure you want to delete <span class="dname"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class="btn actionBtn" data-dismiss="modal" id="editbtn">
                                <span id="footer_action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                            </button>
                        </div>
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
                    {!! Form::open(['route'=>'album.destroy_album','id'=>'FormDelete','class'=>'form-horizontal']) !!}

                    <div class="modal-body">
                        <div class="deleteContent" >
                            {!!form::text('DeleteAlbumID','',['class'=>'form-control hide','id'=>'DeleteAlbumID'])!!}
                            @lang('message.sure_delete') <span class="name"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class='btn  btn-danger btn-destroy'>
                                <span class='glyphicon glyphicon-trash'></span>  @lang('default.delete')
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span>  取消
                            </button>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


        <div id="create_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">@lang('default.create')</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" id="album_create" >
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="create_album_name">@lang('default.album_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="create_album_name" name="create_album_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="create_album_type">@lang('default.album_type'):</label>
                                <div class="col-sm-4" align="left">
                                    {!! Form::select('create_album_type',$AlbumType,'',
                                            ['placeholder'=>'請選擇相簿類型','style'=>'width:200px','id'=>'create_album_type']) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-store btn-success" id="editbtn" >
                                    <span id="footer_action_button" class='glyphicon glyphicon-ok'> </span> @lang('default.create')
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
        <input type="text" class="form-control" id="current_page" disabled value="" style="display:none;">

        <div id="album_edit" style="display: none;">
            @include('admin.album.edit')
        </div>
@endsection
@section('footer-js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

    <script>

        $(document).on('click', '.edit-modal', function() {
//           alert($('#album_name'+$(this).data('info')).text());

            var id = $(this).data('info');
            $.ajax({
                type: 'get',
                url: '{{route('album.edit')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id,
                    'page':$('#layer_current_page').val()
                },
                success: function(data) {
                    $('.files').html('');
                    $('#AlbumName').val($('#album_name'+id).text());
                    $('#album_type').val($('#album_type'+id).text());
                    $('.layer_page_content').html(data['page_content']);
                    $('.layer_page').html(data['page']);
                    layer.open({
                        type: 1,
                        title: '相簿編輯',
                        area: ['1000px', '100%'], //宽高
                        anim: 2,
                        shadeClose: true, //开启遮罩关闭
                        content: $('#album_edit')
                    });

                },error:function(requestObject, error, errorThrown)
                {
                    alert('{{trans('message.error')}}');
                }
            });

        });


        /*
            當按下新增按鈕時，會去做的事情
        */
        $(document).on('click', '.btn-info', function() {

            $('#create_modal').modal('show');
        });


        $(document).on('click', '.delete-modal', function() {

            var stuff = $(this).data('info');

            $('#DeleteAlbumID').val(stuff);
            $('#DeleteModel').modal('show');
        });


        $(document).on('click', '.btn-destroy', function() {

            var id = $('#DeleteAlbumID').val();
            layer.msg('{{trans('message.data_destroy')}}', {
                icon: 16,
                time: 1500,
                shade: 0.01
            });
            $.ajax({
                type: 'post',
                url: '{{route('album.destroy_album')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id,
                    'page':$('#current_page').val()
                },
                success: function(data) {
                    $('.page_content').html(data['page_content']);
                    $('.page').html(data['page']);
                    alert('{{trans('message.destroy_successful')}}');
                    $('#DeleteModel').modal('hide');

                },error:function(requestObject, error, errorThrown)
                {
                    alert('{{trans('message.error')}}');
                }
            });

        });

        $().ready(function() {

            $('#album_create').validate({
                rules: {
                    create_album_name: {
                        required: true
                    }
                },
                messages: {
                    create_album_name: '{{trans('message.err_album_name')}}'
                }
                ,
                submitHandler: function(form) {
//                    alert($('#create_album_name').val());
                    layer.msg('{{trans('message.data_submit')}}', {
                        icon: 16,
                        time: 1500,
                        shade: 0.01
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{route('album.create')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'album_name':$('#create_album_name').val(),
                            'album_type':$('#create_album_type').val(),
                            'page':$('#current_page').val()
                        },
                        success: function(data) {
                            $('.page_content').html(data['page_content']);
                            $('.page').html(data['page']);
                            alert('{{trans('message.store_successful')}}');
                            $('#create_modal').modal('hide');

                        },error:function(requestObject, error, errorThrown)
                        {
                            alert(errorThrown);
                            alert('{{trans('message.error')}}');
                        }
                    });
                }
            });
        });

        var upload_url='{{route('album.upload')}}';
        var destory_url='{{route('album.destroy_photo')}}';
        var pagination_url = '{{route('album.paginate')}}';
        var layer_pagination_url = '{{route('album.layer_paginate')}}';
    </script>

    <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                <strong class="error text-danger"></strong>
            </td>
            <td>
                <p class="size">Processing...</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            </td>
            <td>
                {% if (!i && !o.options.autoUpload) { %}
                    <button class="btn btn-primary start" disabled>
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start</span>
                    </button>
                {% } %}
                {% if (!i) { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download ">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle">
                {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{asset('js/JqueryFileUpload/jquery.ui.widget.js')}}"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{asset('js/JqueryFileUpload/jquery.iframe-transport.js')}}"></script>
    <!-- The basic File Upload plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload.js')}}"></script>
    <!-- The File Upload processing plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-process.js')}}"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-image.js')}}"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-audio.js')}}"></script>
    <!-- The File Upload video preview plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-video.js')}}"></script>
    <!-- The File Upload validation plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-validate.js')}}"></script>
    <!-- The File Upload user interface plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-ui.js')}}"></script>
    <!-- The main application script -->
    <script src="{{asset('js/JqueryFileUpload/main.js')}}"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="js/JqueryFileUpload/cors/jquery.xdr-transport.js"></script>
@stop