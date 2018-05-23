@extends('admin.layouts.layout_web')
<!--/tab_section-->
@section('content')
    <!--/tab_section-->
    <div class="tabs_section" id="menu">
        <div class="container">
            <h5>就是愛 MENU</h5>
            <div id="horizontalTab">
                <ul class="resp-tabs-list">
                    <li> 煎餅果子</li>
                    <li> 飯糰</li>
                    {{--<li> TO DAY SPECIALS</li>--}}
                    {{--<li> DRINKS</li>--}}
                </ul>
                <div class="resp-tabs-container">

                    <div class="tab1">
                        <div class="recipe-grid">
                            @if(count($MenuPanCake)>0)
                                @foreach($MenuPanCake as $item)
                                    <div class="col-md-6 menu-grids">
                                        <div class="menu-text_wthree">
                                            <div class="menu-text-left">
                                                <label class="btn btn-primary">
                                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                    @lang('default.select_photo')&hellip;
                                                    <input type="file" name="fileupload[]" multiple style="display:none;" class="upl" data-info="{{$item->id}}">
                                                </label>
                                                <button class="edit-modal btn btn-info">
                                                    <span class="glyphicon glyphicon-edit"></span> @lang('default.store')
                                                </button>
                                                <div class="rep-img">
                                                    <img src="{{$item->photo}}" alt="" class="img-responsive" id="preview{{$item->id}}">
                                                </div>
                                                <div class="rep-text">
                                                    <input type="text" class="form-control" name="menu_flavor_name" id="menu_prod_name{{$item->id}}" placeholder="口味名稱" value="{{$item->prod_name}}">
                                                    <input type="text" class="form-control" name="menu_flavor_intro" id="menu_prod_intro{{$item->id}}" placeholder="食材" value="{{$item->prod_intro}}">
                                                    <input type="text" class="form-control" name="menu_prod_price" id="menu_prod_price{{$item->id}}" placeholder="價格" value="{{$item->price}}">
                                                </div>
                                                <div class="clearfix"> </div>
                                                <hr>
                                            </div>
                                        </div>

                                        {{--<div class="menu-text-right">--}}
                                        {{--<input type="text" class="form-control" name="menu_prod_price" id="menu_prod_price{{$item->id}}" placeholder="價格" value="{{$item->price}}">--}}
                                        {{--</div>--}}
                                        {{--<div class="clearfix"> </div>--}}
                                    </div>


                                    {{--<div class="col-md-6 menu-grids">--}}
                                    {{--<div class="menu-text_wthree">--}}
                                    {{--<div class="menu-text-left">--}}
                                    {{--<div class="clearfix"> </div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="menu-text-right">--}}

                                    {{--</div>--}}
                                    {{--<div class="clearfix"> </div>--}}
                                    {{--</div>--}}
                                @endforeach
                            @endif
                            {{--<div class="col-md-6 menu-grids">--}}
                            {{--<div class="menu-text_wthree">--}}

                            {{--<div class="menu-text-left">--}}
                            {{--<label class="btn btn-primary">--}}
                            {{--<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">--}}
                            {{--@lang('default.select_photo')&hellip;--}}
                            {{--<input type="file" name="fileupload[]" multiple style="display:none;" class="upl" data-info="">--}}
                            {{--</label>--}}
                            {{--<button class="edit-modal btn btn-info">--}}
                            {{--<span class="glyphicon glyphicon-edit"></span> @lang('default.store')--}}
                            {{--</button>--}}
                            {{--<div class="rep-img">--}}
                            {{--<img src="http://pos/storage/album/商品口味/gal1.jpg" alt=" " class="img-responsive" id="preview">--}}
                            {{--</div>--}}
                            {{--<div class="rep-text">--}}
                            {{--<input type="text" class="form-control" name="menu_flavor_name" id="menu_flavor_name" placeholder="口味名稱" value="經典原味煎餅果子">--}}
                            {{--<input type="text" class="form-control" name="menu_flavor_material" id="menu_flavor_material" placeholder="食材" value="with wild mushrooms and asparagus">--}}
                            {{--</div>--}}

                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text-right">--}}
                            {{--<input type="text" class="form-control" name="menu_flavor_price" id="menu_flavor_price" placeholder="價格" value="50">--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}

                            {{--<div class="menu-text_wthree">--}}
                            {{--<div class="menu-text-left">--}}
                            {{--<div class="rep-img">--}}
                            {{--<img src="http://pos/storage/album/商品口味/gal2.jpg" alt=" " class="img-responsive">--}}
                            {{--</div>--}}
                            {{--<div class="rep-text">--}}
                            {{--<h4>德式香腸煎餅果子............</h4>--}}
                            {{--<h6>with wild mushrooms and asparagus</h6>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text-right">--}}
                            {{--<h4>$60</h4>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text_wthree">--}}
                            {{--<div class="menu-text-left">--}}
                            {{--<div class="rep-img">--}}
                            {{--<img src="http://pos/storage/album/商品口味/gal3.jpg" alt=" " class="img-responsive">--}}
                            {{--</div>--}}
                            {{--<div class="rep-text">--}}
                            {{--<h4>黑胡椒洋蔥雞肉煎餅果子............</h4>--}}
                            {{--<h6>with wild mushrooms and asparagus</h6>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}

                            {{--<div class="menu-text-right">--}}
                            {{--<h4>$65</h4>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text_wthree">--}}
                            {{--<div class="menu-text-left">--}}
                            {{--<div class="rep-img">--}}
                            {{--<img src="http://pos/storage/album/商品口味/gal3.jpg" alt=" " class="img-responsive">--}}
                            {{--</div>--}}
                            {{--<div class="rep-text">--}}
                            {{--<h4>玉米煎餅果子............</h4>--}}
                            {{--<h6>with wild mushrooms and asparagus</h6>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}

                            {{--<div class="menu-text-right">--}}
                            {{--<h4>$50</h4>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 menu-grids">--}}
                            {{--<div class="menu-text_wthree">--}}

                            {{--<div class="menu-text-left">--}}
                            {{--<div class="rep-img">--}}
                            {{--<img src="http://pos/storage/album/商品口味/gal4.jpg" alt=" " class="img-responsive">--}}
                            {{--</div>--}}
                            {{--<div class="rep-text">--}}
                            {{--<h4>美式牽絲起司煎餅果子............</h4>--}}
                            {{--<h6>with wild mushrooms and asparagus</h6>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text-right">--}}
                            {{--<h4>$45</h4>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}

                            {{--<div class="menu-text_wthree">--}}
                            {{--<div class="menu-text-left">--}}
                            {{--<div class="rep-img">--}}
                            {{--<img src="http://pos/storage/album/商品口味/gal5.jpg" alt=" " class="img-responsive">--}}
                            {{--</div>--}}
                            {{--<div class="rep-text">--}}
                            {{--<h4>泰式打拋豬煎餅果子............</h4>--}}
                            {{--<h6>with wild mushrooms and asparagus</h6>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}

                            {{--<div class="menu-text-right">--}}
                            {{--<h4>$65</h4>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text_wthree">--}}
                            {{--<div class="menu-text-left">--}}
                            {{--<div class="rep-img">--}}
                            {{--<img src="http://pos/storage/album/商品口味/gal6.jpg" alt=" " class="img-responsive">--}}
                            {{--</div>--}}
                            {{--<div class="rep-text">--}}
                            {{--<h4>健康蔬菜煎餅果子............</h4>--}}
                            {{--<h6>with wild mushrooms and asparagus</h6>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text-right">--}}
                            {{--<h4>$45</h4>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text_wthree">--}}
                            {{--<div class="menu-text-left">--}}
                            {{--<div class="rep-img">--}}
                            {{--<img src="http://pos/storage/album/商品口味/gal6.jpg" alt=" " class="img-responsive">--}}
                            {{--</div>--}}
                            {{--<div class="rep-text">--}}
                            {{--<h4>鮪魚洋蔥煎餅果子............</h4>--}}
                            {{--<h6>with wild mushrooms and asparagus</h6>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--<div class="menu-text-right">--}}
                            {{--<h4>$55</h4>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"> </div>--}}
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <div class="tab2">
                        <div class="recipe-grid">
                            <div class="col-md-6 menu-grids">
                                <div class="menu-text_wthree">

                                    <div class="menu-text-left">
                                        <div class="rep-img">
                                            <img src="http://pos/storage/album/商品口味/gal9.jpg" alt=" " class="img-responsive">
                                        </div>
                                        <div class="rep-text">
                                            <h4>經典原味飯糰............</h4>
                                            <h6>with wild mushrooms and asparagus</h6>
                                        </div>

                                        <div class="clearfix"> </div>
                                    </div>
                                    <div class="menu-text-right">
                                        <h4>$35</h4>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>

                                <div class="menu-text_wthree">
                                    <div class="menu-text-left">
                                        <div class="rep-img">
                                            <img src="http://pos/storage/album/商品口味/gal7.jpg" alt=" " class="img-responsive">
                                        </div>
                                        <div class="rep-text">
                                            <h4>健康蔬菜飯糰............</h4>
                                            <h6>with wild mushrooms and asparagus</h6>
                                        </div>

                                        <div class="clearfix"> </div>
                                    </div>
                                    <div class="menu-text-right">
                                        <h4>$40</h4>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="menu-text_wthree">
                                    <div class="menu-text-left">
                                        <div class="rep-img">
                                            <img src="http://pos/storage/album/商品口味/gal8.jpg" alt=" " class="img-responsive">
                                        </div>
                                        <div class="rep-text">
                                            <h4>德式香腸飯糰............</h4>
                                            <h6>with wild mushrooms and asparagus</h6>
                                        </div>

                                        <div class="clearfix"> </div>
                                    </div>

                                    <div class="menu-text-right">
                                        <h4>$60</h4>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                            <div class="col-md-6 menu-grids">
                                <div class="menu-text_wthree">

                                    <div class="menu-text-left">
                                        <div class="rep-img">
                                            <img src="http://pos/storage/album/商品口味/gal7.jpg" alt=" " class="img-responsive">
                                        </div>
                                        <div class="rep-text">
                                            <h4>黑胡椒洋蔥雞肉飯糰............</h4>
                                            <h6>with wild mushrooms and asparagus</h6>
                                        </div>

                                        <div class="clearfix"> </div>
                                    </div>
                                    <div class="menu-text-right">
                                        <h4>$65</h4>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>

                                <div class="menu-text_wthree">
                                    <div class="menu-text-left">
                                        <div class="rep-img">
                                            <img src="http://pos/storage/album/商品口味/gal8.jpg" alt=" " class="img-responsive">
                                        </div>
                                        <div class="rep-text">
                                            <h4>鮪魚洋蔥飯糰............</h4>
                                            <h6>with wild mushrooms and asparagus</h6>
                                        </div>

                                        <div class="clearfix"> </div>
                                    </div>

                                    <div class="menu-text-right">
                                        <h4>$55</h4>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="menu-text_wthree">
                                    <div class="menu-text-left">
                                        <div class="rep-img">
                                            <img src="http://pos/storage/album/商品口味/gal9.jpg" alt=" " class="img-responsive">
                                        </div>
                                        <div class="rep-text">
                                            <h4>泰式打拋豬飯糰............</h4>
                                            <h6>with wild mushrooms and asparagus</h6>
                                        </div>

                                        <div class="clearfix"> </div>
                                    </div>
                                    <div class="menu-text-right">
                                        <h4>$65</h4>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>

                        <div class="clearfix"></div>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /tabs -->
    <!--//tab_section-->

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
                    $img_id='#preview'+$img_id;
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
            alert($(this).data('info'));
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
    </script>
@endsection