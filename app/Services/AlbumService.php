<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/6
 * Time: 下午6:40
 */

namespace App\Services;
use Storage;
use Imagecow\Image;
use Response;
use StdClass;
use URL;
use Validator;

use App\Repositories\AlbumDRepository;
use Auth;

class AlbumService {

    private $Files;
    private $AlbumPath;
    private $AlbumName;
    private $FullAlbumPath;
    private $EntityStoragePath;
    private $VirtualStoragePath;


    public function __construct($strImage=null,$strAlbumName=null){
        $this->EntityStoragePath=$this->getEntitiyStoragePath();
    }

    public function getEntitiyStoragePath(){
        return Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
    }

    public function CreateAlbum($strAlbumName=null){


        if($strAlbumName==null)
        {
            Storage::makeDirectory($this->VirtualStoragePath);
            Storage::makeDirectory($this->VirtualStoragePath.'/thumb');
        }else{
            Storage::makeDirectory('public/'.config('app.album').'/'.$strAlbumName);
            Storage::makeDirectory('public/'.config('app.album').'/'.$strAlbumName.'/thumb');
        }

    }

    public function UploadAlbum($strAlbumId){


        foreach ($this->Files as $file) {
            //\Debugbar::info($path);
            $ImageName = $file->getClientOriginalName();
            //$uploadFlag = $file->move($path,$ImageName);
            /*
             * 2017/12/22   使用Laravel內建儲存檔案的方法
             *              此處會將檔案存到指定路徑下(storage下)，
             *              第一個參數是完整資料夾
             *              第二個參數是圖片檔案
             * */
            $uploadFlag=Storage::put(
                $this->VirtualStoragePath.'/'.$ImageName,
                file_get_contents($file->getRealPath())
            );


            \Debugbar::info(storage_path());
            \Debugbar::info(Storage::url($this->VirtualStoragePath));
            \Debugbar::info(URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName)));
            \Debugbar::info(Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix());
            \Debugbar::info(URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName)));
            \Debugbar::info(URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName)));

            //\Debugbar::info($file->getRealPath());
            if($uploadFlag){
                //Using Imagick:
                $Image = Image::fromFile($this->EntityStoragePath.$this->FullAlbumPath.'/'.$ImageName);
                $Image->resize('8%', '8%');
                $Image->save($this->EntityStoragePath.$this->FullAlbumPath.'/thumb/'.$ImageName);
                $info = new StdClass;
                $info->name = $ImageName;
                $info->id = $ImageName;
                $info->size = 1024;
                $info->type = 'png';
                $info->VirtualPath = $this->VirtualStoragePath.'/'.$ImageName;
                $info->url = URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName));
                $info->thumbnailUrl = URL::to(Storage::url($this->FullAlbumPath.'/thumb/'.$ImageName));
                $info->deleteUrl = URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName));
                $info->delete_method = 'GET';
                $info->error = null;
                $data[] = $info;
                AlbumDRepository::Save($strAlbumId,$data);
            }
            else {

            }
        }
        return $data;
    }

    public function DeleteAlbum(){

        Storage::deleteDirectory($this->VirtualStoragePath);

    }

    public function DeleteAlbumImage($DeleteFiles){
        Storage::delete($DeleteFiles);
    }

    public function UpdateAlbum(){

    }

    public function SetAlbumName($strAlbumName){
        $this->AlbumName=$strAlbumName;
        $this->FullAlbumPath = config('app.album').'/'.$strAlbumName;
        $this->VirtualStoragePath = 'public/'.$this->FullAlbumPath;
    }

    public function SetAlbumPath($strAlbumPath){
        $this->AlbumPath=$strAlbumPath;
    }

    public function SetFiles($strFiles){

        if($strFiles->hasFile('fileupload')){
            $rules = array('fileupload'  => 'image');
            $data = array('image' => $strFiles->file('fileupload'));
            // Validation
            $validation = Validator::make($data, $rules);
//            \Debugbar::info($strFiles);
            if ($validation->fails())
            {
                \Debugbar::info('433');
                throw new Exception($validation->messages()->all()); // 丟出一個測試用的例外
            }

            \Debugbar::info($strFiles->file('fileupload'));
            $this->Files=$strFiles->file('fileupload');

        }

    }

    public function GetAlbumPath(){
        return $this->FullAlbumPath;
    }

    public function GetAlbumContent($strImages){
        if($images = $strImages){
            $OriginImage = array();
            $Count=0;
            foreach($images as $image){
                $OriginImage[$Count]['name'] = $image->name;
                $OriginImage[$Count]['id'] = $image->id;
                $OriginImage[$Count]['url'] = $image->photo_path;
                $OriginImage[$Count]['delete_url'] = URL::to(Storage::url($this->FullAlbumPath.'/'.$image->name));
                $OriginImage[$Count]['url_thumb'] = URL::to(Storage::url($this->FullAlbumPath.'/thumb/'.$image->name));
                $OriginImage[$Count]['delete_method'] = 'GET';
                $Count++;
            }
            return $OriginImage;
        }

    }

    /*
     * 將分頁內容在下方function組成畫面內容
     * $CurrentPage:目前畫面正在第幾頁
     * $data:要顯示在畫面上的內容
     *
     * */
    public function getPage($CurrentPage,$data){

        $page = $CurrentPage;
        $res = '';

        foreach($data['data'] as $val){
            $res .= '<tr class="item'.$val->id.'">';
            $res .='<td align="center" style="width:20%"><p id="album_name'.$val->id.'">'.$val->album_name.'</p></td>';
            $res .='<td align="center" style="width:20%"><p id="status'.$val->id.'">'.$val->status.'</p></td>';
            $res .='<td align="center" style="width:20%"><p id="created_at'.$val->id.'">'.$val->created_at.'</p></td>';
            $res .='<td style="width:20%" align="center">';
            if(Auth::guard('admin')->user()->hasRule('admin.album.edit')){
                $res .='<button class="edit-modal btn btn-success" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-edit"></span>'.trans('default.edit').
                    '</button>';
            }
            if(Auth::guard('admin')->user()->hasRule('admin.album.destroy')){
                $res .=' <button class="delete-modal btn btn-danger" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-trash"></span>'.trans('default.delete').
                    '</button>';
            }
            $res .='</td>';
            $res .='</tr>';
        }

        $pagination='';
        $pagination .='<div class="page">';
        $pagination .='<!-------分页---------->' ;
        if($data['count'] > 5){
            $pagination .= '<ul class="pagination">';
            if($page != 1){
                $pagination .='<li>';
                $pagination .='<a href="javascript:void(0)" onclick="page('.$data['prev'].')"><span class="glyphicon glyphicon-chevron-left"></span></a>';
                $pagination .='</li>';
            }else{
                $pagination .='<li class="disabled">';
                $pagination .='<a href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-left"></span></a>';
                $pagination .='</li>';
            }
            foreach($data['pages'] as $k=>$v){
                if($v == $data['page']){
                    $pagination .='<li class="active"><span>'.$v.'</span></li>';

                }else{
                    $pagination .='<li>' ;
                    $pagination .='<a href="javascript:void(0)" onclick="page('.$v.')">'.$v.'</a>' ;
                    $pagination .='</li>' ;
                }

            }
            if($page != $data['sums']){
                $pagination .= '<li>';
                $pagination .= '<a href="javascript:void(0)" onclick="page('.$data['next'].')"><span class="glyphicon glyphicon-chevron-right"></span></a>' ;
                $pagination .= '</li>';
            }else{
                $pagination .= '<li class="disabled">';
                $pagination .= '<a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right"></span></a>' ;
                $pagination .= '</li>';
            }
            $pagination .='</ul>';
        }

        $Return=array('page_content'=>$res,'page'=>$pagination);

        return $Return;


    }

    public function getPageD($CurrentPage,$data){

        $page = $CurrentPage;
        $res = '';

        if(count($data['data'])>0){
            foreach($data['data'] as $val){

                $res .='<div class="col-md-4 text-center" id="container_'.$val->id.'">';
                $res .='<div class="thumbnail">';
                $res .='<input type="checkbox" name="delete" value="'.$val->id.'"class="toggle"><hr>';
                $res .='<img class="img-responsive img-portfolio img-hover" src="'.$val->photo_path.'"style="width:650px;height:220px;" >';
                $res .='<div align="left">';
                $res .=trans('default.file_name').'：<input type="text"  style="border-style:none;outline:none" readonly="true" >';
                $res .='<div align="right">';
                if(Auth::guard('admin')->user()->hasRule('album.destroy_photo')){
                    $res .='<button class="delete btn btn-danger" data-info="'.$val->id.'">
                                    <span class="glyphicon glyphicon-trash"></span>'.trans('default.delete').
                           '</button>';
                }
                $res .='</div>';
                $res .='</div>';
                $res .='</div>';
                $res .='</div>';

            }
            $res .='<input type="text" class="form-control" id="album_id" disabled value="'.$data['data'][0]->album_id.'" style="display:none;">';
        }

            $pagination='';
        $pagination .='<div class="page">';
        $pagination .='<!-------分页---------->' ;
        if($data['count'] > 5){
            $pagination .= '<ul class="pagination">';
            if($page != 1){
                $pagination .='<li>';
                $pagination .='<a href="javascript:void(0)" onclick="layer_page('.$data['prev'].')"><span class="glyphicon glyphicon-chevron-left"></span></a>';
                $pagination .='</li>';
            }else{
                $pagination .='<li class="disabled">';
                $pagination .='<a href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-left"></span></a>';
                $pagination .='</li>';
            }
            foreach($data['pages'] as $k=>$v){
                if($v == $data['page']){
                    $pagination .='<li class="active"><span>'.$v.'</span></li>';

                }else{
                    $pagination .='<li>' ;
                    $pagination .='<a href="javascript:void(0)" onclick="layer_page('.$v.')">'.$v.'</a>' ;
                    $pagination .='</li>' ;
                }

            }
            if($page != $data['sums']){
                $pagination .= '<li>';
                $pagination .= '<a href="javascript:void(0)" onclick="layer_page('.$data['next'].')"><span class="glyphicon glyphicon-chevron-right"></span></a>' ;
                $pagination .= '</li>';
            }else{
                $pagination .= '<li class="disabled">';
                $pagination .= '<a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right"></span></a>' ;
                $pagination .= '</li>';
            }
            $pagination .='</ul>';
        }

        $Return=array('page_content'=>$res,'page'=>$pagination);

        return $Return;

    }


}