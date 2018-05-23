<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FlavorRepository;
use DB;

class FlavorController extends Controller
{
    private $FlavorRepository;

    public function __construct(FlavorRepository $FlavorRepository)
    {
        $this->FlavorRepository = $FlavorRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dtFlavor = $this->FlavorRepository->getAll();
        $strTestFlavor=$this->FlavorRepository->getAllTest(['flavor_name','money'])->toArray();
        $data = $this->FlavorRepository->page('',5,1);

        return view('admin.flavor.index')->with('dtFlavor',$dtFlavor)->with('data',$data);

    }

    /*
     * 根據使用者點選畫面上的分頁
     * 到後端取得資料在吐回給使用者
     * 使用Ajax方法
     * */
    public function getPage(Request $request){
        return $this->FlavorRepository->getPage($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $this->FlavorRepository->create($request);

            DB::connection()->getPdo()->commit();

            flash(trans('message.create_successful'))->success()->important();

            return response ()->json ( $this->FlavorRepository->getPage($request),200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
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
        try{
            DB::connection()->getPdo()->beginTransaction();

            $this->FlavorRepository->store($request);


            DB::connection()->getPdo()->commit();

            return response ()->json ( ['ServerNo'=>'200'],200);

        }catch (\PDOException $e)
        {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $dtFlavor = $this->FlavorRepository->getFlavorById($request->id);
            \Debugbar::info($dtFlavor->flavor_name);

            DB::connection()->getPdo()->commit();

            return response ()->json ( ['ServerNo'=>'200','Data'=>$dtFlavor],200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
        }
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
    public function destroy(Request $request)
    {
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $this->FlavorRepository->destroy($request->id);

            DB::connection()->getPdo()->commit();

            return response ()->json ( $this->FlavorRepository->getPage($request),200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
        }

    }
}
