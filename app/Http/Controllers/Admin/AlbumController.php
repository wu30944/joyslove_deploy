<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\SystemCodeRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\AlbumDRepository;

use DB;
use App\Services\AlbumService;
use Response;
use App\Services\PaginationService;

class AlbumController extends Controller
{

    private $objAlbum;
    private $objAlbumD;
    private $AlbumService;
    private $PaginationService;
    private $SystemCode;

    public function __construct(AlbumRepository $AlbumRepository,
                                AlbumDRepository $AlbumDRepository,
                                SystemCodeRepository $SystemCode
                                )
    {
        $this->objAlbum = $AlbumRepository;
        $this->objAlbumD = $AlbumDRepository;
        $this->AlbumService = new AlbumService();
        $this->PaginationService = new PaginationService();
        $this->SystemCode=$SystemCode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dtAlbum = $this->objAlbum->getOrderByPageing(10);

        $Columns = array('id','album_name','status','created_at');

        $QueryResult = $this->objAlbum->getAlbumByCondition($request,$Columns);

        $data=$this->PaginationService->page('',$QueryResult,'5','1');

        $AlbumType=$this->SystemCode->getWhere('album_type','')->pluck('zh_code_val','code_id')->toArray();

        return view('admin.album.index')->with('Album',$dtAlbum)->with('data',$data)->with('AlbumType',$AlbumType);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {

            DB::connection()->getPdo()->beginTransaction();

            $this->AlbumService->CreateAlbum($request->album_name);

            $this->objAlbum->create($request);

            $Columns = array('id','album_name','status','created_at');
            $QueryResult = $this->objAlbum->getAlbumByCondition($request,$Columns);

            $data=$this->PaginationService->page($request->page,$QueryResult,'5','1');
            \Debugbar::info($data);
            $Return = $this->AlbumService->getPage($request->page,$data);

            DB::connection()->getPdo()->commit();

            return response ()->json ( $Return,200);

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( $e,404);
//            return view('errors.503');
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
    public function edit(Request $request)
    {
        try{

            $Columns = array('id','album_id','photo_name','photo_path','photo_thumb_path','photo_virtual_path');
            $strAlbumId = array($request->id);
            $AlbumContent = $this->objAlbumD->getAlbumDByCondition($strAlbumId,$Columns);
            $data = $this->PaginationService->page('',$AlbumContent,'9','1');
            $Return = $this->AlbumService->getPageD('',$data);
            return Response::json($Return,200);

        }catch(\PDOException $e){
            return view('errors.503');
        }

    }

    public function LoadOriginItem(Request $request){
        \Debugbar::info($request);
//        $strAlbumId=$this->objAlbum->GetAlbumId($strAlbumName);
//        $strImages=$this->objAlbumD->GetAlbumInfo($strAlbumId);
//        $data=$this->AlbumService->GetAlbumContent($strImages);
        return Response::json(array('files'=>NULL));
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
    public function DestroyAlbum(Request $request)
    {
        //
        try {

            $id=$request->id;
            DB::connection()->getPdo()->beginTransaction();


            $strAlbumName=$this->objAlbum->GetAlbumName($id);
            $this->objAlbum->delete($id);
            $this->objAlbumD->DeleteAlbum($id);

            \Debugbar::info($strAlbumName);
            $this->AlbumService->SetAlbumName($strAlbumName);
            $this->AlbumService->DeleteAlbum();

            DB::connection()->getPdo()->commit();


            $Columns = array('id','album_name','status','created_at');
            $QueryResult = $this->objAlbum->getAlbumByCondition($request,$Columns);
            $data=$this->PaginationService->page($request->page,$QueryResult,'5','1');
            $Return = $this->AlbumService->getPage($request->page,$data);
            \Debugbar::info($Return);

            return response ()->json ( $Return,200);


        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }

    }

    public function DestoryPhoto(Request $request)
    {
        //
        try {
            $DeleteAlbumId=$request->DeletePhotoId;
            DB::connection()->getPdo()->beginTransaction();

            $DeletePhotoVirtualPath=$this->objAlbumD->GetPhotoVirtualPath($DeleteAlbumId);

            \Debugbar::info($DeletePhotoVirtualPath);
            $this->AlbumService->DeleteAlbumImage($DeletePhotoVirtualPath);
            $Result = $this->objAlbumD->DeletePhoto($DeleteAlbumId);
            DB::connection()->getPdo()->commit();
            return response ()->json (['Message'=>$Result['Message']],200);
            //return back()->with('success', trans('message.DeleteSuccess'));

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }

    }

    /*
     * 上傳照片會跑來此function
     * 他會先去呼叫上傳照片的Class
     * 要先初始該類別，必須傳入相簿名稱、並且給予要上傳的照片
     * 當照片確認放入實體位置後，類別會回傳照片資訊回來，
     * 最後，再將這些相關資訊存入album_d這個table
     * */
    public function upload(Request $request){
        try{
            // Path for guest upload
            DB::connection()->getPdo()->beginTransaction();
            $files=$request;
            $this->AlbumService->SetAlbumName($request->AlbumName);
            $this->AlbumService->SetFiles($files);
            $strAlbumId = $this->objAlbum->GetAlbumId($request->AlbumName);
            $data=$this->AlbumService->UploadAlbum($strAlbumId);
            DB::connection()->getPdo()->commit();

            return Response::json(array('files'=>$data));

        }catch (Exception $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json (['Message'=>$e->getMessage()],403);
        }
    }

    /*
     * 根據使用者點選畫面上的分頁
     * 到後端取得資料在吐回給使用者
     * 使用Ajax方法
     * */
    public function getPage(Request $request){

        $Columns = array('id','album_name','status','created_at');

        $QueryResult = $this->objAlbum->getAlbumByCondition($request,$Columns);

        $data=$this->PaginationService->page($request->page,$QueryResult,'5','1');

        $Return = $this->AlbumService->getPage($request->page,$data);
        \Debugbar::info($Return);

        return response ()->json ( $Return,200);
    }

    public function getPageD(Request $request){

        $Columns = array('id','album_id','photo_name','photo_path','photo_thumb_path','photo_virtual_path');
        $strAlbumId = array($request->id);
        $AlbumContent = $this->objAlbumD->getAlbumDByCondition($strAlbumId,$Columns);
        $data = $this->PaginationService->page($request->page,$AlbumContent,'9','1');
        $Return = $this->AlbumService->getPageD($request->page,$data);
        return Response::json($Return,200);

        return response ()->json ( $Return,200);
    }


}
