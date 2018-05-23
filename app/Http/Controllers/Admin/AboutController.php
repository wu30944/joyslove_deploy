<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PaginationService;
use App\Repositories\AboutRepository;
use App\Services\AboutService;
use DB;

class AboutController extends Controller
{
    private $PaginationService;
    private $AboutRepository;
    private $AboutService;
    
    public function __construct(AboutRepository $AboutRepository)
    {
        $this->PaginationService = new PaginationService();
        $this->AboutRepository = $AboutRepository;
        $this->AboutService = new AboutService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dtAbout = $this->AboutRepository->getAll();
        $Columns = array('id','zh_company_name','en_company_name'
                        ,'address','fex','telephone'
                        ,'email','zh_introduction','en_introduction'
                        ,'uniform_number','status');

        $QueryResult = $this->AboutRepository->getAboutByCondition($request,$Columns);
        $data=$this->PaginationService->page(1,$QueryResult,'5','1');

        return view('admin.about.index')->with('data',$data)->with('About',$dtAbout);
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


            $this->AboutRepository->create($request);



            $Columns = array('id','zh_company_name','en_company_name'
                                ,'address','fex','telephone'
                                ,'email','zh_introduction','en_introduction'
                                ,'uniform_number','status');
            $QueryResult = $this->AboutRepository->getAboutByCondition($request,$Columns);

            $data=$this->PaginationService->page($request->page,$QueryResult,'5','1');
            \Debugbar::info($data);
            $Return = $this->AboutService->getPage($request->page,$data);

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
        //
        try{

            $dtAbout = $this->AboutRepository->getAboutById($request->id);

            return response ()->json ( ['Data'=>$dtAbout],200);

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
    public function destroy($id)
    {
        //
    }
}
