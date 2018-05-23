@extends('admin.layouts.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-warning alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            系统权限菜单，非专业技术人员请勿修改、增加、删除等操作。
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>权限列表</h5>
        </div>
        <div class="ibox-content">
            <a href="{{route('navigate.create')}}" link-url="javascript:void(0)"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 添加权限</button></a>
            <table class="table table-striped table-bordered table-hover m-t-md">
                <thead>
                    <tr>
                        <th>@lang('default.function_name')</th>
                        <th>@lang('default.function_route')</th>
                        <th class="text-center" width="100">@lang('default.icon')</th>
                        <th class="text-center" width="100">@lang('default.sort')</th>
                        <th class="text-center" width="100">@lang('default.is_show')</th>
                        <th class="text-center" width="250">@lang('default.option')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rules as $k=>$item)
                <tr>
                    <td>{{$item['_name']}}</td>
                    <td>{{$item['route']}}</td>
                    <td style="text-align:center"><i class="fa fa-{{isset($item['fonts']) ? $item['fonts'] : 'desktop'}}"></i></td>
                    <td class="text-center">{{$item['sort']}}</td>
                    <td class="text-center">
                        @if($item['is_hidden'] == 0)
                            <span class="text-navy">@lang('default.show')</span>
                        @else
                            <span class="text-danger">@lang('default.hide')</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{route('navigate.edit',$item['id'])}}">
                            <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                        </a>
                        @if($item['is_hidden'] == 1)
                         <a href="{{route('navigate.status',['status'=>0,$item['id']])}}">
                             <button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button>
                         </a>
                        @else
                        <a href="{{route('navigate.status',['status'=>1,$item['id']])}}">
                            <button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 不显示</button>
                        </a>
                        @endif
                        <form class="form-common" action="{{route('navigate.destroy',$item['id'])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i> 删除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection