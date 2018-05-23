<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;
use App\Repositories\MenuRepository;

class MenuController extends Controller
{
    private $MenuRepository;

    public function __construct(MenuRepository $MenuRepository)
    {
        $this->MenuRepository=$MenuRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $request = new StdClass;
        $request->menu_name = '';
        $request->prod_name = '';
        $request->status = '1';
        $Columns = array('id','menu_name','prod_name'
        ,'prod_intro','photo','price','status');

        $dtMenu = $this->MenuRepository->getMenuByCondition($request,$Columns)->get();

        $Columns = array('menu_name');
        $request->menu_name='';
        $dtMenuTitle = $this->MenuRepository->getMenuByCondition($request,$Columns)->groupBy('menu_name')->get();
        \Debugbar::info($dtMenuTitle->toArray());

        return view('admin.menu.index')->with('Menu',$dtMenu)
                                            ->with('Title',$dtMenuTitle);
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
