<?php

namespace App\Repositories;


use App\Models\Navigate;

class NavigateRepository
{
    /**
     * 添加权限
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return Navigate::create($params);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return Navigate::find($id);
    }

    /**
     * 根据路由名称获取路由的详细信息
     * @param $route
     * @return mixed
     */
    public function ByRoute($route)
    {
        return Navigate::where('route',$route)->first();
    }

    /**
     * 获取全部权限只限显示的数据
     * @return mixed
     */
    public function getNavigateAndPublic()
    {
        return Navigate::orderBy('sort','asc')->public()->get();
    }

    /**
     * 获取全部权限
     * @return mixed
     */
    public function getRules()
    {
        return Navigate::orderBy('sort','asc')->get();
    }

    public function getShowRules()
    {
        return Navigate::where('is_hidden','=','0')->orderBy('sort','asc')->get();
    }
}