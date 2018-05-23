<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:11
 */
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\About;
use Validator;
use Response;
use Auth;

class AboutRepository
{
    private $AboutRepository;

    public function __construct(About $data)
    {
        $this->AboutRepository=$data;
    }

    public function getAll()
    {
        return $this->AboutRepository->orderBy('created_at', 'desc')->paginate(5);
    }

    public function getAllTest($column)
    {
        return $this->AboutRepository->select($column)->get();
    }

    /*
     * 根據使用者點選的項目取出資料
     * */
    public function getAboutById($id){
        return $this->AboutRepository->select('id','zh_company_name','en_company_name'
                                                    ,'address','fex','telephone'
                                                    ,'email','zh_introduction','en_introduction'
                                                    ,'uniform_number','status')->find($id)->first();
    }

    public function store(Request $request)
    {
        \Debugbar::info($request);
        $data = $this->AboutRepository->find($request->id);
        $data->zh_company_name = $request->zh_company_name;
        $data->en_company_name = $request->en_company_name;
        $data->address = $request->address;
        $data->fex = $request->fex;
        $data->telephone = $request->telephone;
        $data->email = $request->email;
        $data->zh_introduction = $request->zh_introduction;
        $data->en_introduction=$request->en_introduction;
        $data->uniform_number=$request->uniform_number;
        $data->status=$request->status;
        $data->save ();
    }

    public function create(Request $request){
//        \Debugbar::info($request->zh_company_name);
//        \Debugbar::info($request->en_company_name);
//        \Debugbar::info($request->address);
//        \Debugbar::info($request->fex);
//        \Debugbar::info($request->telephone);
//        \Debugbar::info($request->email);
//        \Debugbar::info($request->zh_introduction);
//        \Debugbar::info($request->en_introduction);
//        \Debugbar::info($request->uniform_number);
//        \Debugbar::info($request->stauts);


        $data = new About();
        $data->zh_company_name = $request->zh_company_name;
        $data->en_company_name = $request->en_company_name;
        $data->address = $request->address;
        $data->fex = $request->fex;
        $data->telephone = $request->telephone;
        $data->email = $request->email;
        $data->zh_introduction = $request->zh_introduction;
        $data->en_introduction=$request->en_introduction;
        $data->uniform_number=$request->uniform_number;
        $data->status=$request->status;
        $data->save ();

    }

    public function destroy($id)
    {
        $this->AboutRepository->find($id)->delete();
    }

    public function getAboutByCondition(Request $request,$columns){

        return $this->AboutRepository->select($columns)
        ->where(function($SubQuery) use ($request) {
            $SubQuery->where('zh_company_name','=',$request->zh_company_name)
                ->orwhereRaw("''=IFNULL(?,'')", [$request->zh_company_name]);
        })->where(function($SubQuery) use ($request) {
            $SubQuery->where('en_company_name','=',$request->en_company_name )
                ->orwhereRaw("''=IFNULL(?,'')", [$request->en_company_name]);
        });

    }

}