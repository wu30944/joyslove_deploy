<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:11
 */
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\StoreInfo;
use Validator;
use Response;
use Auth;

class StoreInfoRepository
{
    private $StoreInfoRepository;

    public function __construct(StoreInfo $data)
    {
        $this->StoreInfoRepository=$data;
    }

    public function getAll()
    {
        return $this->StoreInfoRepository->orderBy('created_at', 'desc')->paginate(5);
    }

    public function getAllTest($column)
    {
        return $this->StoreInfoRepository->select($column)->get();
    }

    /*
     * 根據使用者點選的項目取出資料
     * */
    public function getAboutById($id){
        return $this->StoreInfoRepository->select('id','zh_company_name','en_company_name'
                                                    ,'address','fex','telephone'
                                                    ,'email','zh_introduction','en_introduction'
                                                    ,'uniform_number','status')->find($id)->first();
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return StoreInfo::find($id);
    }


    public function store(Request $request)
    {
        \Debugbar::info($request);
        $data = $this->StoreInfoRepository->find($request->id);
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

    public function create(array $param){

        $data = new StoreInfo();
        $data->store_name = $param['store_name'];
        $data->local = $param['local'];
        $data->address = $param['address'];
        $data->open_time = $param['open_time'];
        $data->close_time = $param['close_time'];
        $data->telephone = $param['telephone'];
        $data->is_hidden = $param['is_hidden'];
        $data->status= $param['status'];

        $data->save ();

    }

    public function destroy($id)
    {
        $this->StoreInfoRepository->find($id)->delete();
    }

    public function getStoreInfoByCondition(array $param,$columns){

        return $this->StoreInfoRepository->select($columns)
        ->where(function($SubQuery) use ($param) {
            $SubQuery->where('store_name','=',$param['store_name'])
                ->orwhereRaw("''=IFNULL(?,'')", [$param['store_name']]);
        })->where(function($SubQuery) use ($param) {
                $SubQuery->where('local','=',$param['local'])
                    ->orwhereRaw("''=IFNULL(?,'')", [$param['local']]);
            })->where(function($SubQuery) use ($param) {
                $SubQuery->where('id','=',$param['id'])
                    ->orwhereRaw("''=IFNULL(?,'')", [$param['id']]);
            })->where(function($SubQuery) use ($param) {
                $SubQuery->where('is_hidden','=',$param['is_hidden'])
                    ->orwhereRaw("''=IFNULL(?,'')", [$param['is_hidden']]);
            })->where(function($SubQuery) use ($param) {
            $SubQuery->where('status','=',$param['status'] )
                ->orwhereRaw("''=IFNULL(?,'')", [$param['status']]);
        });

    }

}