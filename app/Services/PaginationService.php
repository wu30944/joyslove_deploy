<?php

namespace App\Services;


class PaginationService
{
    public function page($CurrentPage='',$table,$num,$class='1'){

        $page = $CurrentPage; // 获取当前页数
        if(empty($page)) {
            $page = 1;
        }
        \Debugbar::info($page);
        $count = '';
        switch($class){
            case 1:
                $count = $table->get()->count();  // 查询数据总条数
                break;
            case 2:
                $count = $table->get()->count();  // 查询数据总条数
                break;
        }

        $rev = $num; // 每页显示条数
        $sums = ceil($count / $rev); // 求总页数
        $pages = array();  // 页数
        for ($i = 1; $i <= $sums; $i++) {
            $pages[$i] = $i;
        }
        $prev = ($page - 1) > 0 ? $page - 1 : 1; // 设置上一页
        $next = ($page + 1) < $sums ? $page + 1 : $sums; // 设置下一页
        $offset = ($page - 1) * $rev; // 求偏移量
        $data = '';
// 根据条件查询不同的数据
        switch ($class){
            case 1:
                $data = $table->orderBy('created_at', 'desc')->skip($offset)->take($rev)->get();  // 跟据条件查询数据
                break;
            case 2:
                $data = $table->orderBy('created_at', 'desc')->skip($offset)->take($rev)->get();  // 跟据条件查询数据
                break;
        }
        return array(
            'data' => $data,
            'prev' => $prev,
            'next' => $next,
            'page' => $page,
            'pages' => $pages,
            'sums' => $sums,
            'count' => $count
        );
    }

}