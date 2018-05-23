<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StoreInfoService;
use App\Services\PaginationService;
use DB;

class StoreInfoController extends Controller
{

    protected $StoreInfoService;
    protected $PaginationService;

    public function __construct(StoreInfoService $StoreInfoService,PaginationService $PaginationService)
    {
        $this->StoreInfoService = $StoreInfoService;
        $this->PaginationService = $PaginationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //

        $columns = array('id','store_name');
        $param = ['id'=>'','store_name'=>'','local'=>'','is_hidden'=>'','status'=>''];
        $StoreInfo = $this->StoreInfoService->getStoreInfoContent($param,$columns);

        $data=$this->PaginationService->page(1,$StoreInfo,'5','1');

        return view('admin.store_info.index')->with('StoreInfo',$StoreInfo->get())->with('data',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.store_info.create');
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
        return redirect()->route('store_info.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeByAjax(Request $request)
    {
        //
        try{
            DB::connection()->getPdo()->beginTransaction();
            $this->StoreInfoService->create($request->toArray());
            DB::connection()->getPdo()->commit();

            $columns = array('id','store_name');
            $param = ['id'=>'','store_name'=>'','local'=>'','is_hidden'=>'','status'=>''];
            $StoreInfo = $this->StoreInfoService->getStoreInfoContent($param,$columns);

            /*1.利用分頁的Services，取出要顯示在畫面上的資料*/
            $data=$this->PaginationService->page(1,$StoreInfo,'5','1');
            /*2.利用*/
            $pageContent = $this->StoreInfoService->getPageContent($data);

            return response ()->json ( $pageContent,200);

        }catch (\PDOException $e)
        {
            \Debugbar::info($e->getMessage());
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }
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


    public function edit(Request $request)
    {
        //
        $id = $request->id;
        $columns = array('id','store_name','local','address','open_time','close_time','telephone','is_hidden','status');
        $param = ['id'=>$id,'store_name'=>'','local'=>'','is_hidden'=>'','status'=>''];
        $StoreInfo = $this->StoreInfoService->getStoreInfoContent($param,$columns);
        \Debugbar::info($StoreInfo->get()->toArray()[0]);

        return response ()->json ( $StoreInfo->get()->toArray()[0],200);

    }

    public function post_edit($id)

    {
//        $columns = array('id','store_name');
//        $param = ['id'=>'','store_name'=>'','local'=>'','is_hidden'=>'','status'=>''];
//        $StoreInfo = $this->StoreInfoService->getStoreInfoContent($param,$columns);
//
//        $data=$this->PaginationService->page(1,$StoreInfo,'5','1');

        return 1;//view('admin.store_info.index')->with('StoreInfo',$StoreInfo->get())->with('data',$data);
    }


    public function update(Request $request)
    {
        //
        $storeInfo = $this->StoreInfoService->ById($request->id);
//        if(is_null($storeInfo))
//        {
//            flash('你无权操作')->error()->important();
//        }

        $storeInfo->update($request->all());
        \Debugbar::info($request->all());

        $currentPage=$request->page;
        $columns = array('id','store_name');
        $param = ['id'=>'','store_name'=>'','local'=>'','is_hidden'=>'','status'=>''];
        $StoreInfo = $this->StoreInfoService->getStoreInfoContent($param,$columns);

        /*1.利用分頁的Services，取出要顯示在畫面上的資料*/
        $data=$this->PaginationService->page($currentPage,$StoreInfo,'5','1');
        /*2.利用*/
        $pageContent = $this->StoreInfoService->getPageContent($data);

        return response ()->json ( $pageContent,200);

    }

    public function destroy(Request $request)
    {
        $storeInfo = $this->StoreInfoService->ById($request->id);

        if(empty($storeInfo))
        {

        }

        $storeInfo->delete();

        //
        $currentPage=$request->page;
        $columns = array('id','store_name');
        $param = ['id'=>'','store_name'=>'','local'=>'','is_hidden'=>'','status'=>''];
        $StoreInfo = $this->StoreInfoService->getStoreInfoContent($param,$columns);

        /*1.利用分頁的Services，取出要顯示在畫面上的資料*/
        $data=$this->PaginationService->page($currentPage,$StoreInfo,'5','1');
        /*2.利用*/
        $pageContent = $this->StoreInfoService->getPageContent($data);

        return response ()->json ( $pageContent,200);
    }

    /*
     * 根據使用者點選畫面上的分頁
     * 到後端取得資料在吐回給使用者
     * 使用Ajax方法
     * */
    public function getPage(Request $request){

        $currentPage=$request->page;
        $columns = array('id','store_name');
        $param = ['id'=>'','store_name'=>'','local'=>'','is_hidden'=>'','status'=>''];
        $StoreInfo = $this->StoreInfoService->getStoreInfoContent($param,$columns);

        /*1.利用分頁的Services，取出要顯示在畫面上的資料*/
        $data=$this->PaginationService->page($currentPage,$StoreInfo,'5','1');
        /*2.利用*/
        $pageContent = $this->StoreInfoService->getPageContent($data);

        return response ()->json ( $pageContent,200);
    }
}
