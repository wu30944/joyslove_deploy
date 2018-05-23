@section('css')
    {{--2018/01/08  相簿資料維護--}}
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Generic page styles -->
    <link rel="stylesheet" href="/css/fileupload/style.css">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="/css/fileupload/jquery.fileupload.css">
    <link rel="stylesheet" href="/css/fileupload/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="/css/fileupload/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="/css/fileupload/jquery.fileupload-ui-noscript.css"></noscript>
    {{--2018/01/08  相簿資料維護--}}

    <style>
        .table-borderless tbody tr td, .table-borderless tbody tr th,
        .table-borderless thead tr th {
            border: none;
        }
    </style>
@stop
    <div class="row ">
        <div class="ibox-content panel panel-simple marginbottom0">

            {{--@if ($message = Session::get('success'))--}}
                {{--<div class="alert alert-success alert-block">--}}
                    {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
                    {{--<strong>{{ $message }}</strong>--}}
                {{--</div>--}}
            {{--@elseif($message = Session::get('fails'))--}}
                {{--<div class="alert alert-danger alert-block">--}}
                    {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
                    {{--<strong>{{ $message }}</strong>--}}
                {{--</div>--}}

            {{--@endif--}}
            <div class="panel-group" id="UploadPart">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#UploadPart"
                               href="#collapseOne">
                                @lang('default.upload_photo')
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-heading success">
                            <h3 class="panel-title"><i class="fa fa-picture-o"></i> 張貼照片 <span class="panel-under"></span></h3>
                        </div>
                        <form id="post-form" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="modal-body " >
                                    <div class="form-group">
                                        <label class="control-label" for="Album">@lang('default.album_name'):</label>
                                        <input type="text" class="form-control" name="AlbumName" id="AlbumName" placeholder="輸入相簿名稱" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">@lang('default.album_type'):</label>
                                        <div class="col-sm-4" align="left">
                                            {!! Form::select('chart_model',$AlbumType,'',
                                                    ['placeholder'=>'請選擇相簿類型','style'=>'width:200px','id'=>'album_type']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-left: 0px;display:none" class="errorMessage" id="Post_image_em_"></div>
                                <div class="row fileupload-buttonbar marginbottom10">
                                    <div class="col-sm-12 col-xs-14">

                                        <div class="row">
                                            <div class="col-md-8 col-xs-12">
                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <label class="btn btn-primary">
                                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                        @lang('default.select_photo')&hellip; <input type="file" name="fileupload[]" multiple style="display:none;">
                                                    </label>
                                                </div>

                                                <button type="submit" class="btn btn-primary start">
                                                    <i class="glyphicon glyphicon-upload"></i>
                                                    <span>@lang('default.all_upload')</span>
                                                </button>
                                            </div>
                                            <div class="col-md-16 hidden-sm hidden-xs">
                                                或者在這裡拖放照片
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-11 col-xs-10 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" style="margin: 0;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="bar progress-bar" style="width:0%;">
                                            </div>
                                        </div>
                                        <!-- The extended global progress information -->
                                    </div>
                                </div>
                                <div class="visible-sm visible-xs text-small text-muted">
                                    如果您的設備上傳了有缺陷的圖像，請釋放RAM並逐個向上。
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <div id="upload-grid">
                                    <table role="presentation" class="table table-striped table-hover table-condensed">
                                        <tbody class="files">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion"
                               href="#collapseTwo">
                                @lang('default.album_photo')
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        @if(Gate::forUser(auth('admin')->user())->check('admin.Album.DestoryPhoto'))
                            <button class="delete btn btn-danger"
                                    data-info="">
                                <span class="glyphicon glyphicon-trash"></span> @lang('default.batch_delete')
                            </button>
                        @endif
                        <div class="panel-body">
                            <table>
                                <tbody class="layer_page_content" >
                                    {{--@if (isset($Images))--}}
                                        {{-- expr --}}
                                        {{--@foreach($Images as $item)--}}
                                            {{--<div class="col-md-4 text-center" id="container_{{$item->id}}">--}}
                                                {{--<div class="thumbnail">--}}
                                                    {{--<input type="checkbox" name="delete" value="{{$item->id}}" class="toggle">--}}
                                                    {{--<hr>--}}
                                                    {{--<img class="img-responsive img-portfolio img-hover" src="{{$item->photo_path}}" style="width:650px;height:220px;" id="action_photo_link_{{$item->id}}">--}}

                                                    {{--<div class="" align="left">--}}
                                                        {{--<p>--}}
                                                            {{--@lang('default.file_name')：<input class=""  type="text" id="photo_name_{{$item->id}}" value="{{$item->photo_name}}" style="border-style:none;outline:none" readonly="true" >--}}
                                                        {{--</p>--}}
                                                        {{--<input  type="text" id="AlbumId" value="{{$item->album_id}}" style="display:none" readonly="true" >--}}
                                                        {{--<div align="right">--}}
                                                            {{--@if(Gate::forUser(auth('admin')->user())->check('admin.Album.DestoryPhoto'))--}}
                                                                {{--<button class="delete btn btn-danger"--}}
                                                                        {{--data-info="{{$item->id}}">--}}
                                                                    {{--<span class="glyphicon glyphicon-trash"></span> @lang('default.delete')--}}
                                                                {{--</button>--}}
                                                            {{--@endif--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                </tbody>
                            </table>
                            <div class="box-header">
                                <div class="box-tools">
                                    {{--{{$dtFlavor->links()}}--}}
                                    @include('admin.commons.layer_pagination')
                                </div>
                            </div>
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
                    <div class="modal-body">
                        <div class="deleteContent" >
                          @lang('default.sure_delete') <span class="name"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class='btn  btn-danger delete-modal'>
                                <span class='glyphicon glyphicon-trash'></span>  @lang('default.delete')
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span>  取消
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="text" class="form-control" id="layer_current_page" disabled value="" style="display:none;">
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a> <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
