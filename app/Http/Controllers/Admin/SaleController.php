<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\SystemCodeRepository;
use App\Repositories\FlavorRepository;
use App\Repositories\UserOrderRepository;
use App\Services\UserOrderService;
use DB;
use StdClass;
use Auth;
use App\Repositories\AdminsRepository;

class SaleController extends Controller
{
    private $FlavorRepository;
    private $SystemCode;
    private $UserOrder;
    private $UserOrderService;
    private $AdminsRepository;

    public function __construct(FlavorRepository $FlavorRepository,
                                SystemCodeRepository $SystemCode,
                                UserOrderRepository $UserOrder,
                                UserOrderService $UserOrderService,
                                AdminsRepository $AdminsRepository)
    {
        $this->FlavorRepository = $FlavorRepository;
        $this->SystemCode = $SystemCode;
        $this->UserOrder = $UserOrder;
        $this->UserOrderService=$UserOrderService;
        $this->AdminsRepository=$AdminsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ChartModel=$this->SystemCode->getWhere('chart','')->pluck('zh_code_val','code_id')->toArray();
        $StoreName = $this->AdminsRepository->getAll()->pluck('store_name','id')->toArray();
//         \Debugbar::info($StoreName->pluck('id','store_name')->toArray());
        return view('admin.sale.index')->with('ChartModel',$ChartModel)->with('StoreName',$StoreName);
    }

    /*
     * 取得要顯示統計表的模式
     * */
    public function  getStatisticModel(Request $request){

        $strFlavorName=$this->FlavorRepository->getStatusFlavor(['1'])->pluck('flavor_name')->toArray();


        $strDate=$this->UserOrderService->getChartDate($request);
        $Result=$this->UserOrder->getStatisticChartData($strDate,$request->AdminId);

        $strData =  array();
        $strYAxis = $this->UserOrderService->getYAxisTitle($request->ChartModel);

        $strChartCodeId=NULL;
        if($request->ChartModel==NULL){
            $strChartCodeId='00004';
        }else{
            $strChartCodeId=$request->ChartModel;
        }
        $StoreName=NULL;
        if($request->AdminId==NULL){
            $StoreName='所有分店 ';
        }else{
            $StoreName = $this->AdminsRepository->ById($request->AdminId)->store_name." ";
        }

        $strTitle=$this->SystemCode->getWhere('chart',$strChartCodeId)->pluck('zh_code_val')->toArray();

        if($strYAxis=="數量"){
            for($i=0;$i<count($Result);$i++){
                $strData[$i]=(float)$Result[$i]->order_num;
            }
        }else{
            $strMoney = 0;
            for($i=0;$i<count($Result);$i++){
                $strData[$i]=(float)$Result[$i]->money;
                $strMoney=$strMoney+$Result[$i]->money;
            }
            $strTitle=$StoreName.$strTitle[0]." 總金額：".(string)$strMoney."元";
        }


        return response ()->json ( ['FlavorName'=>$strFlavorName,'Data'=>$strData,'yAxis'=>$strYAxis,'Title'=>$strTitle],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
