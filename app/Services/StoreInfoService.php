<?php
namespace App\Services;


use App\Repositories\StoreInfoRepository;
use App\Http\Requests;
use Auth;

class StoreInfoService
{
    protected $StoreInfoRepository;

    /**
     * RulesService constructor.
     * @param StoreInfoRepository $StoreInfoRepository
     */
    public function __construct(StoreInfoRepository $StoreInfoRepository)
    {

        $this->StoreInfoRepository = $StoreInfoRepository;
    }

    /**
     * 创建权限数据
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        \Debugbar::info($params['telephone']);
        return $this->StoreInfoRepository->create($params);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->StoreInfoRepository->ById($id);
    }

    public function getStoreInfoContent(array $request,array $columns){

        return $this->StoreInfoRepository->getStoreInfoByCondition($request,$columns);

    }


    /*
     * 將畫面上view的內容組起來
     * */
    public function getPageContent(array $data)
    {
        $res = '';
        $page= $data['page'];

        foreach($data['data'] as $val){
            $res .= '<tr class="item'.$val->id.'">';
            $res .='<td align="center"  style="width:30%"><p id="company_name'.$val->id.'">'.$val->store_name.'</p></td>';
            $res .='<td align="center">';
            if(Auth::guard('admin')->user()->hasRule('admin.store_info.edit')){
                $res .='<button class="edit-modal btn btn-info" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-edit"></span>'.trans('default.edit').
                       '</button>';
            }
            if(Auth::guard('admin')->user()->hasRule('admin.store_info.destroy')){
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

        $Return=array('page_content'=>$res,'page'=>$pagination,'page_num'=>$page);

        return $Return;
    }
}