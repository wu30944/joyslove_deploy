<div class="layer_page">
    <!-------分页---------->
    @if($data['count'] > 5)
        <ul class="pagination">
            @if($data['page'] !=1)
                <li>
                    <a href="javascript:void(0)" onclick="layer_page({{$data['prev']}})" ><span class="glyphicon glyphicon-chevron-left"></span></a>
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
                        <a href="javascript:void(0)" onclick="layer_page({{$v}})">{{$v}}</a>
                    </li>
                @endif

            @endforeach

            <li>
                <a href="javascript:void(0)" onclick="layer_page({{$data['next']}})"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </li>

        </ul>
    @endif
</div>

<!-------分页---------->
<script>
    function layer_page(page){
        //加载层
        layer.msg('{{trans('message.data_loading')}}', {
            icon: 16,
            time: 1500,
            shade: 0.01
        });
        // 发异步请求完成分页
        $.ajax({
            type: "POST",
            url: layer_pagination_url,
            dataType: 'json',
            cache: false,
            data: { page: page,
                    id:$('#album_id').val(),
                _token: "{{csrf_token()}}"},
            success: function(data) {

                if(data){
                    $('.layer_page_content').html(data['page_content']);
                    $('.layer_page').html(data['page']);
                    $('#layer_current_page').val(page);
                }
            }
        });

    }
</script>