<div class="page">
    <!-------分页---------->
    @if($data['count'] > 5)
        <ul class="pagination">
            @if($data['page'] !=1)
                <li>
                    <a href="javascript:void(0)" onclick="page({{$data['prev']}})" ><span class="glyphicon glyphicon-chevron-left"></span></a>
                </li>
            @else
                <li class="disabled">
                    <a href="javascript:void(0)"  disabled="false"><span class="glyphicon glyphicon-chevron-left"></span></a>
                </li>
            @endif
            @foreach($data['pages'] as $k=>$v)
                @if($v == $data['page'])
                    <li class="active"><span>{{$v}}</span></li>
                @else
                    <li >
                        <a href="javascript:void(0)" onclick="page({{$v}})">{{$v}}</a>
                    </li>
                @endif

            @endforeach

            <li>
                <a href="javascript:void(0)" onclick="page({{$data['next']}})"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </li>

        </ul>
    @endif
</div>

<!-------分页---------->
<script>



    function page(page){
        //加载层
        {{--layer.msg('{{trans('message.data_loading')}}', {--}}
            {{--icon: 16,--}}
            {{--time: 1500,--}}
            {{--shade: 0.01--}}
        {{--});--}}
        // 发异步请求完成分页
        NProgress.start();
        var i ;
        $.ajax({
            type: "POST",
            url: pagination_url,
            dataType: 'json',
            cache: false,
            data: { page: page,
                    _token: "{{csrf_token()}}"},
            beforeSend: function () {
                i = showLoadLayer();
            },
            success: function(data) {

                if(data){
                    $('.page_content').html(data['page_content']);
                    $('.page').html(data['page']);
                    $('#current_page').val(page);
                }
                closeLoadLayer(i);
                NProgress.done();
            },error:function(requestObject, error, errorThrown)
            {
                alert(errorThrown);
                {{--var errors=e.responseJSON;--}}
                {{--if(errors.Message!=""){--}}
                    {{--alert(errors.Message);--}}
                {{--}else{--}}
                    {{--alert('{{trans('message.error')}}');--}}
                {{--}--}}

            }
        });

    }
</script>