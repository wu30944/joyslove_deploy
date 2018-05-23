<?php

namespace App\Http\Controllers\joyslove;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Repositories\AlbumRepository;
use App\Repositories\AlbumDRepository;
use App\Repositories\SystemCodeRepository;
use App\Repositories\AboutRepository;

class IndexController extends Controller
{
    private $AlbumRepository;
    private $AlbumDRepository;
    private $SystemCodeRepository;
    private $AboutRepository;

    public function __construct(AlbumRepository $AlbumRepository,
                                AlbumDRepository $AlbumDRepository,
                                SystemCodeRepository $SystemCode,
                                AboutRepository $AboutRepository
    )
    {
        $this->AlbumRepository = $AlbumRepository;
        $this->AlbumDRepository = $AlbumDRepository;
        $this->SystemCodeRepository=$SystemCode;
        $this->AboutRepository = $AboutRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strAlbumId=$this->AlbumRepository->GetBannerAlbumId();
        $Columns = array('id','album_id','photo_name','photo_path','photo_thumb_path','photo_virtual_path');
        $AlbumContent = $this->AlbumDRepository->getAlbumDByCondition($strAlbumId,$Columns);

//        \Debugbar::info($AlbumContent->get()->toArray());

        $About = $this->AboutRepository->getAboutById(1)->toArray();
        \Debugbar::info($About);

        return view('joyslove.home.home')->with('Banner',$AlbumContent->get())
                                              ->with('About',$About);
    }

    public function main()
    {
        return view('admin.indexs.main');
    }
}
