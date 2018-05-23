<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use App\Models\SystemCode;
    use Validator;
    use Response;

    class SystemCodeRepository
    {
        private $SystemCodeRepository;

        public function __construct(SystemCode $data)
        {
            $this->SystemCodeRepository=$data;
        }

        public function getAll()
        {
        	return $this->SystemCodeRepository->all();
        }

        public function getWhere($code_type,$code_id)
        {
            return $this->SystemCodeRepository->where('code_type','=',$code_type)
                                                ->where(function($SubQuery)  {
                                                    $SubQuery->where('end_date','>=',date("Y-m-d" ))
                                                        ->orwhereRaw("1 = 1");
                                                })->where(function($SubQuery) use($code_id)  {
                                                    $SubQuery->where('code_id','=',$code_id)
                                                             ->orwhereRaw("''=IFNULL(?,'')", [$code_id]);
                                                })
                                              ->orderBy('code_id')->get();
        }

        public function save(Request $request)
        {
            $rules = array (
            'name'=> 'required',
            'cod_id'=>'required'
            );


            $validator = Validator::make ( $request->all(), $rules );
            if ($validator->fails ()){       
                 // return Response::json ( 
                 //    array ('errors' => $validator->messages()->all() ));
                  return response()->json(['ServerNo' => '404','errors' =>  $validator->messages()->all()]);
            }
            else {
                 
                 
                if($request->id==NULL)
                {

                    $data = new action_photo();
                }else{
                    $data = $this->SystemCodeRepository->find($request->id);
                }

               
                $data->title = $request->theme;
                $data->photo_link = $request->photo_link;
                $data->content = $request->content;
                $data->para_1=$request->para_1;
                $data->para_2=$request->para_2;
                $data->para_3=$request->para_3;
                $data->photo_date=$request->photo_date;
                $data->save ();

                // Session::flash('message', 'Successfully updated nerd!');
                // return response ()->json ( $data );
                return response ()->json ( ['ServerNo'=>'200','data'=>$data ]);
            }
        }

        public function delete($id)
        {
            // \Debugbar::info($id);
            $data = $this->SystemCodeRepository->find($id)->delete();
            //MeetingInfo::find ( $request->id )->delete ();
            return response ()->json ();
        }



    }