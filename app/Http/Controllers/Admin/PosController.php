<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FlavorRepository;
use App\Repositories\UserOrderRepository;
use DB;

class PosController extends Controller
{

    private $FlavorRepository;
    private $UserOrderRepository;

    public function __construct(FlavorRepository $FlavorRepository,UserOrderRepository $UserOrderRepository)
    {
        $this->FlavorRepository = $FlavorRepository;
        $this->UserOrderRepository = $UserOrderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $this->UserOrderRepository
        $dtFlavor=$this->FlavorRepository->getStatusFlavor([1]);

        //將還未完成的訂單資料帶出
        $dtUserOrder = $this->UserOrderRepository->DivideOrderContent($this->UserOrderRepository->getTodayUserOrderStatus([2]));

        \Debugbar::info($dtUserOrder);
        return view('admin.pos.index')->with('dtFlavor',$dtFlavor)->with('dtUserOrder',$dtUserOrder);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            DB::connection()->getPdo()->beginTransaction();


            $OrderInfo = $request->OrderInfo;
            $OrderSerialNo = $request->OrderSerialNo;

            if($OrderSerialNo!=""){
                $this->UserOrderRepository->DestroyByOrderSerialNo($OrderSerialNo);
                $this->UserOrderRepository->OrderUpdate($OrderInfo,$OrderSerialNo);
            }else {
                $OrderSerialNo = $this->UserOrderRepository->Create($OrderInfo);
            }
            DB::connection()->getPdo()->commit();

            return response ()->json ( ['ServerNo'=>'200','ResultData'=> $OrderSerialNo,'test'=>'1'],200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['ServerNo'=>'404'],404);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $this->UserOrderRepository->Update($id);

            DB::connection()->getPdo()->commit();

            return response ()->json ( ['ServerNo'=>'200'],200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $this->UserOrderRepository->Destroy($id);

            DB::connection()->getPdo()->commit();

            return response ()->json ( ['ServerNo'=>'200'],200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
        }

    }

    public function UpdateStatus(Request $request){
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $this->UserOrderRepository->UpdateStatus($request->order_serial_no);

            DB::connection()->getPdo()->commit();

            return response ()->json ( ['ServerNo'=>'200'],200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
        }
    }

    /*
     * 取出特定的訂單資料
     * */
    public function  getOrderDetail(Request $request){

        $strOrderSerialNo = $request->order_serial_no;
        $dtOrder = $this->UserOrderRepository->getOrderDetail($strOrderSerialNo);
        \Debugbar::info('1');
        return response ()->json ( ['ServerNo'=>'200','Data'=>$dtOrder],200);
    }

    public function DestroyOrderByOrderSerialNo(Request $request){

        try{
            DB::connection()->getPdo()->beginTransaction();

            \Debugbar::info($request->order_serial_no);

            $this->UserOrderRepository->DestroyByOrderSerialNo($request->order_serial_no);

            DB::connection()->getPdo()->commit();

            return response ()->json ( ['ServerNo'=>'200'],200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['ServerNo'=>'404'],404);
        }

    }
}
