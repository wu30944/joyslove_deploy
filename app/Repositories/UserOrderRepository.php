<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/27
 * Time: 下午11:13
 */
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\UserOrder;
use Validator;
use Response;
use DB;
use StdClass;
use Auth;

class UserOrderRepository
{
    private $UserOrderRepository;

    public function __construct(UserOrder $data)
    {
        $this->UserOrderRepository=$data;
    }

    public function getAll()
    {
        return $this->UserOrderRepository->all();
    }

    /*
     * 取得特定狀態的口味資料
     * */
    public function getTodayUserOrderStatus($status){
        return $this->UserOrderRepository->where('order_date','=',date('Y-m-d'))->whereIn('status',$status)->get();
    }

    /*
     * 將取出的資料作分群
     * 依照顧客的序號
     * 將訂購的口味存入同一個參數位子
     * */
    public function DivideOrderContent($dtUserOrder){

        $ReturnUserOrder=[];

        foreach($dtUserOrder as $Item){
            $info = new StdClass;
            $info->order_serial_no = $Item->order_serial_no;
            $info->flavor_name = $Item->flavor_name.'*'.$Item->order_num;
            $info->money = $Item->money;

            if(isset($ReturnUserOrder[$Item->order_serial_no])){

                $ReturnUserOrder[$Item->order_serial_no]->flavor_name=$ReturnUserOrder[$Item->order_serial_no]->flavor_name."</br>".$info->flavor_name;
                $ReturnUserOrder[$Item->order_serial_no]->money=$ReturnUserOrder[$Item->order_serial_no]->money+$info->money;
                
            }else{

                $ReturnUserOrder[$Item->order_serial_no]=$info;
            }
        }
        return $ReturnUserOrder;
    }

    public function save(Request $request)
    {
        if($request->id=="" || $request->id==NULL)
        {
            $data = new UserOrder();
//            $data->is_show = 0;
//            $data->content = $request->content;
//            $data->chapter = $request->chapter;
//            $data->save ();

        }else{
            $data = $this->UserOrderRepository->find($request->id);
//            $data->flavor_id = $Order[0];
//            $data->flavor_name = $Order[1];
//            $data->order_num = $Order[2];
//            $data->money = $Order[3];
//            $data->status = 2;
//            $data->order_date = date('Y-m-d');
//            $data->save ();

        }
        DB::connection()->getPdo()->commit();
        return  collect(['ServerNo'=>'200','Result' =>'儲存成功！','data'=>$data]);

    }

    public function Create($OrderInfo){

         $OrderSerialNo=$this->getOrderNumber()+1;

        foreach($OrderInfo as $Order){

            if(isset($Order)){
                $data = new UserOrder();
                $data->order_serial_no = $OrderSerialNo;
                $data->admin_id = Auth::guard('admin')->id();
                $data->flavor_id = $Order[0];
                $data->flavor_name = $Order[1];
                $data->order_num = $Order[2];
                $data->money = $Order[3];
                $data->status = 2;
                $data->order_date = date('Y-m-d');
                $data->save ();
            }

        }
        return $OrderSerialNo;
    }

    public function OrderUpdate($OrderInfo,$OrderSerialNo){

        foreach($OrderInfo as $Order){

            if(isset($Order)){
                $data = new UserOrder();
                $data->order_serial_no = $OrderSerialNo;
                $data->admin_id = Auth::guard('admin')->id();
                $data->flavor_id = $Order[0];
                $data->flavor_name = $Order[1];
                $data->order_num = $Order[2];
                $data->money = $Order[3];
                $data->status = 2;
                $data->order_date = date('Y-m-d');
                $data->save ();
            }

        }
        return $OrderSerialNo;
    }

    public function getOrderNumber(){

        return $this->UserOrderRepository
                    ->where('order_date','=',date('Y-m-d'))
                    ->where('admin_id','=',Auth::guard('admin')->id())
                    ->max('order_serial_no');
    }

    public function Destroy($id)
    {
        $this->UserOrderRepository->find($id)->delete();
    }

    /*
     * 如果在資料庫中已有資料，則先將資料刪除，再重新塞入資料
     * */
    public function DestroyByOrderSerialNo($strOrderSerialNo)
    {

        $this->UserOrderRepository
             ->where('order_serial_no','=',$strOrderSerialNo)
             ->where('order_date','=',date('Y-m-d'))
             ->delete();
    }

    /*
     * 更新訂購單狀態
     * */
    public function UpdateStatus($strOrderSerialNo){

       $this->UserOrderRepository->where('order_serial_no','=',$strOrderSerialNo)->update(['status' => 1]);
    }

    /*
     * 取得特定訂購單的資訊
     * */
    public function getOrderDetail($strOrderSerialNo)
    {
        return $this->UserOrderRepository
                    ->where('order_serial_no','=',$strOrderSerialNo)
                    ->where('order_date','=',date('Y-m-d'))
                    ->where('admin_id','=',Auth::guard('admin')->id())
                    ->select('order_serial_no', 'flavor_id','flavor_name','order_num','money')->get();
    }

    /*
     * 根據使用者輸入的條件取出資料
     * 1.年度口味統計
     * 2.季 口味統計
     * 3.月 口味統計
     * 4.日 口味統計
     * 5.年度金額統計
     * 6.季 金額統計
     * 7.月 金額統計
     * 8.日 金額統計
     *
     * SQL:
     * select a.id,a.flavor_name,IFNULL(b.order_num,0) as order_num,IFNULL(b.money,0) as money
     *       from flavor a
     *       left join (select flavor_id,sum(order_num) as order_num,sum(money) as money
     *       from user_order
     *       where order_date between '2018-02-01' and '2018-02-28'
     *       and status='1'
     *       GROUP BY flavor_id) b
     *       on a.id=b.flavor_id
     * */
    public function getStatisticChartData($strDate,$strAdminId){


        return  DB::select(
            'select a.id,a.flavor_name,IFNULL(b.order_num,0) as order_num,IFNULL(b.money,0) as money
                   from flavor a
                   left join (select flavor_id,sum(order_num) as order_num,sum(money) as money
                   from user_order
                    where order_date between ? and ?
                    and status= "1"
                    and (admin_id = ? or IFNULL(?,"") ="")
                    GROUP BY flavor_id) b
                    on a.id=b.flavor_id
        ', [$strDate[0],$strDate[1],$strAdminId,$strAdminId]);


    }



}