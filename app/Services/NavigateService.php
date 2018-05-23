<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/11/13
 * Time: 下午12:32
 */

namespace App\Services;

use App\Handlers\Tree;
use App\Repositories\NavigateRepository;
use Cache;

class NavigateService
{
    protected $tree;

    protected $NavigateRepository;

    // 缓存相关配置
    protected $cache_key = '_cache_rules';

    protected $menu_cache = '_menu_cache'; //菜单缓存key

    /**
     * RulesService constructor.
     * @param NavigateRepository $NavigateRepository
     * @param Tree $tree
     */
    public function __construct(NavigateRepository $NavigateRepository,Tree $tree)
    {
        $this->tree = $tree;

        $this->NavigateRepository = $NavigateRepository;
    }

    /**
     * 创建权限数据
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->NavigateRepository->create($params);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->NavigateRepository->ById($id);
    }

    /**
     * 获取树形结构权限列表
     * @return array
     */
    public function getRulesTree()
    {
        $rules = $this->NavigateRepository->getRules()->toArray();
        \Debugbar::info($rules);
        return Tree::tree($rules,'name','id','parent_id');
    }

    /*＊
     * 取得導覽列的資料
     * */
    public function getNavigateTree()
    {
        $menu_cache =  $this->menu_cache;

        if (!Cache::tags(['rbac', 'menus'])->has($menu_cache))
        {
            $rules = $this->NavigateRepository->getNavigateAndPublic()->toArray();
            debug(Tree::array_tree($rules));


            /**将权限路由存入缓存中*/
            Cache::tags(['rbac', 'menus'])->put($menu_cache, $rules,86400);
        }


        $rules = Cache::tags(['rbac', 'menus'])->get($menu_cache);
        return Tree::array_tree($rules);

    }
}