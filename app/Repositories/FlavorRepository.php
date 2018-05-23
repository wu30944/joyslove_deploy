<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:11
 */
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use App\Models\Flavor;
    use Validator;
    use Response;
    use Auth;

    class FlavorRepository
    {
        private $FlavorRepository;

        public function __construct(Flavor $data)
        {
            $this->FlavorRepository=$data;
        }

        public function getAll()
        {
            return $this->FlavorRepository->orderBy('created_at', 'desc')->paginate(5);
        }

        public function getAllTest($column)
        {
            return $this->FlavorRepository->select($column)->get();
        }

        /*
         * 取得特定狀態的口味資料
         * */
        public function getStatusFlavor($status){
            return $this->FlavorRepository->whereIn('status',$status)->get();
        }

        /*
         * 根據使用者點選的項目取出資料
         * */
        public function getFlavorById($id){
            return $this->FlavorRepository->select('id', 'flavor_name','money','material','status','para_1')->find($id);
        }

        public function store(Request $request)
        {
            \Debugbar::info($request);
            $Data = $this->FlavorRepository->find($request->id);
            $Data->flavor_name = $request->flavor_name;
            $Data->money = $request->money;
            $Data->material = $request->material;
            $Data->status = $request->status;
            $Data->para_1 = $request->para_1;
            $Data->save ();
        }

        public function create(Request $request){

            $data = new Flavor();
            $data->flavor_name = $request->flavor_name;
            $data->money = $request->money;
            $data->material = $request->material;
            $data->status = $request->status;
            $data->para_1=$request->para_1;
            $data->save ();
        }

        public function destroy($id)
        {
            $this->FlavorRepository->find($id)->delete();
        }


        public function page($CurrentPage,$num,$class='1'){

            $page = $CurrentPage; // 获取当前页数
            if(empty($page)) {
                $page = 1;
            }
            $count = '';
            switch($class){
                case 1:
                    $count = $this->FlavorRepository->select('flavor_name')->count();  // 查询数据总条数
                    break;
                case 2:
                    $count = Flavor::select('flavor_name')->where('id',0)->count();  // 查询数据总条数
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
                    $data = Flavor::where('status', 1)->orderBy('created_at', 'desc')->skip($offset)->take($rev)->get();  // 跟据条件查询数据
                    break;
                case 2:
                    $data = Flavor::where(['status'=> 1])->orderBy('created_at', 'desc')->skip($offset)->take($rev)->get();  // 跟据条件查询数据
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

        // 分页请求
        public function getPage(Request $request){

            $data = $this -> page($request->page,5,1);   // 调分页方法每页显示 5条数据
            $page = $request ->input('page','');
            $res = '';

            foreach($data['data'] as $val){
                $res .= '<tr class="item'.$val->id.'">';
                $res .='<td align="left" style="width:20%"><p id="flavor_name'.$val->id.'">'.$val->flavor_name.'</p></td>';
                $res .='<td align="left" style="width:10%"><p id="money'.$val->id.'">'.$val->money.'</p></td>';
                $res .='<td align="left" style="width:10%"><p id="status'.$val->id.'">'.$val->status.'</p></td>';
                $res .='<td style="width:10%" align="center">';
                if(Auth::guard('admin')->user()->hasRule('admin.flavor.edit')){
                    $res .='<button class="edit-modal btn btn-info" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-edit"></span>'.trans('default.edit').
                            '</button>';
                }
                if(Auth::guard('admin')->user()->hasRule('admin.flavor.destroy')){
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