@extends('admin.layouts.layout_web')
<!--/tab_section-->
@section('content')
    <!--/tab_section-->
    <div class="tabs_section" id="menu">
        <div class="container">
            <h5>就是愛 MENU</h5>
            <div id="horizontalTab">
                <ul class="resp-tabs-list">
                    @if(count($Title)>0)
                        @foreach($Title as $item)
                            <li>{{$item->menu_name}}</li>
                        @endforeach
                    @endif
                </ul>

                <div class="resp-tabs-container">
                    @if(count($Title)>0)
                        @foreach($Title as $title)
                            <div class="tab">
                                <div class="recipe-grid">
                                    @if(count($Menu)>0)
                                        @foreach($Menu as $menu)
                                            @if($menu->menu_name == $title->menu_name)
                                                <div class="col-md-6 menu-grids">
                                                    <div class="menu-text_wthree">
                                                        <div class="menu-text-left">

                                                            <div class="rep-img">
                                                                <img src="{{$menu->photo}}" alt="" class="img-responsive" id="preview{{$menu->id}}">
                                                            </div>
                                                            <div class="rep-text">
                                                                <label class="control-label" style="color:white;">@lang('default.flavor_name')：{{$menu->prod_name}} </label>
                                                            </div>
                                                            <div class="rep-text">
                                                                <label class="control-label" style="color:white;">@lang('default.material')：{{$menu->prod_intro}} </label>
                                                            </div>
                                                            <div class="rep-text">
                                                                <label class="control-label" style="color:white;">@lang('default.price')：{{$menu->price}}</label>
                                                            </div>
                                                            <div align="right">
                                                                <button class="edit-modal btn btn-info" data-info="{{$menu->id}}">
                                                                    <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                                                                </button>
                                                            </div>
                                                            <div class="clearfix"> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endforeach
                    @endif
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /tabs -->
    <!--//tab_section-->

    <!-- bootstrap-modal-pop-up -->
    <div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Luscious
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="form_edit" >
                        <label class="btn btn-primary">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            @lang('default.select_photo')&hellip;
                            <input type="file" name="fileupload[]" multiple style="display:none;" class="upl" data-info="{{$item->id}}">
                        </label>
                        <img alt="" class="img-responsive img-circle" id="preview">
                        {{--<img src="images/banner1.jpg" alt=" " class="img-responsive" />--}}
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
    <!-- //bootstrap-modal-pop-up -->


@endsection
@section('footer-js')
    <script>
        var objImg;

        var ImgURL;
        /**
         * 格式化
         * @param   num 要轉換的數字
         * @param   pos 指定小數第幾位做四捨五入
         */
        function format_float(num, pos)
        {
            var size = Math.pow(10, pos);
            return Math.round(num * size) / size;
        }
        /**
         * 預覽圖
         * @param   input 輸入 input[type=file] 的 this
         */
        function preview(input,$img_id) {
            if (!input.files[0].type.match('image.*'))
            {
                alert('您選擇的不是圖片檔案');
                $('#image').attr({value:''});
            }
            else if (input.files && input.files[0] ) {
                var reader = new FileReader();
                objImg=input.files[0];

//                //為了避免使用者上傳照片後，又去編輯其他ITEM的照片，導致上傳照片對應不正確
//                //所以改為當某個項目上傳照片後，將其他項目的更新、選取檔案的控制項改為不能修改的狀態
//                $('.chgupl').not('#image_'+$img_id).attr('disabled',"disabled");
//                $('.save-modal').not('#update_'+$img_id).attr('disabled',"disabled");


                if($img_id=='')
                {
                    $img_id='#preview';
                }else{
                    $img_id='#preview_'+$img_id;
                }

                reader.onload = function (e) {
                    $($img_id).attr('src', e.target.result);
                    var KB = format_float(e.total / 1024, 2);
                    $('.size').text("檔案大小：" + KB + " KB");
                    ImgURL=e.target.result
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("body").on("change", ".upl", function (){
            //alert($(this).data('info'));
            $id_info = $(this).data('info');

            if(typeof($id_info)=='undefined')
            {
                $img_id = '';
            }
            else{
                $img_id = $id_info;

            }
            preview(this,$img_id);
        });


        $(document).on('click', '.edit-modal', function() {

            $('#myModal input').val('');
            $('#myModal').modal('show');
            return;
            var id =  $(this).data('info');
            layer.msg('{{trans('message.data_loading')}}', {
                icon: 16,
                time: 1500,
                shade: 0.01
            });
            $.ajax({
                type: 'post',
                url: '{{route('menu.edit')}}',
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

    </script>
@endsection