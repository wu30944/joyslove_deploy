<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/6
 * Time: 下午6:40
 */

namespace App\Services;

use Auth;

class AboutService {


    public function __construct(){

    }

    /*
     * 將分頁內容在下方function組成畫面內容
     * $CurrentPage:目前畫面正在第幾頁
     * $data:要顯示在畫面上的內容
     *
     * */
    public function getPage($CurrentPage,$data){

        $page = $CurrentPage;
        $res = '';

        foreach($data['data'] as $val){
            $res .= '<tr class="item'.$val->id.'">';
            $res .='<td align="center" style="width:20%"><p id="company_name'.$val->id.'">'.$val->zh_company_name.'</p></td>';
            $res .='<td style="width:20%" align="center">';
            if(Auth::guard('admin')->user()->hasRule('admin.about.edit')){
                $res .='<button class="edit-modal btn btn-success" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-edit"></span>'.trans('default.edit').
                    '</button>';
            }
            if(Auth::guard('admin')->user()->hasRule('admin.about.destroy')){
                $res .=' <button class="delete-modal btn btn-danger" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-trash"></span>'.trans('default.delete').
                    '</button>';
            }
            $res .='</td>';
            $res .='</tr>';
        }

        $pagination='';
        $pagination .='<div class="page">';
        $pagination .='<!-------分页---------->' ;
        if($data['count'] > 5){
            $pagination .= '<ul class="pagination">';
            if($page != 1){
                $pagination .='<li>';
                $pagination .='<a href="javascript:void(0)" onclick="page('.$data['prev'].')"><span class="glyphicon glyphicon-chevron-left"></span></a>';
                $pagination .='</li>';
            }else{
                $pagination .='<li class="disabled">';
                $pagination .='<a href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-left"></span></a>';
                $pagination .='</li>';
            }
            foreach($data['pages'] as $k=>$v){
                if($v == $data['page']){
                    $pagination .='<li class="active"><span>'.$v.'</span></li>';

                }else{
                    $pagination .='<li>' ;
                    $pagination .='<a href="javascript:void(0)" onclick="page('.$v.')">'.$v.'</a>' ;
                    $pagination .='</li>' ;
                }

            }
            if($page != $data['sums']){
                $pagination .= '<li>';
                $pagination .= '<a href="javascript:void(0)" onclick="page('.$data['next'].')"><span class="glyphicon glyphicon-chevron-right"></span></a>' ;
                $pagination .= '</li>';
            }else{
                $pagination .= '<li class="disabled">';
                $pagination .= '<a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right"></span></a>' ;
                $pagination .= '</li>';
            }
            $pagination .='</ul>';
        }

        $Return=array('page_content'=>$res,'page'=>$pagination);

        return $Return;

    }




}