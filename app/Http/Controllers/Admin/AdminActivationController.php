<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class AdminActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->except('_token');
        $data['password'] = Crypt::encrypt($data['password']);
        $result = User::create($data);
        if($result) {
            $token = bcrypt( $result->email . time());
            # 發送郵件
            Mail::send('admin.email.send', ['user'=>$result,'token'=>$token], function($message)  use ($result) {
                $subject = '愛麗社區激活郵件';
                $message->to( $result->email )->subject($subject);
            });


            // 保存激活信息
            $addData = [
                'token' => $token,
                'user_id' => $result->id,
            ];

            $res = UserActivation::create($addData);
            if ($res) {
                return redirect( 'admin/user' );
            } else {
                return back()->with('errors', 'userActivation表數據填充失敗!');
            }
        } else {
            return back()->with('errors', 'user表數據填充失敗!');
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
