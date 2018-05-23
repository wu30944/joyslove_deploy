<?php

namespace App\Services;

use Illuminate\Http\Request;
class UserOrderService
{
    protected $UserOrder;


    public function getChartDate($request){
        $strSDate=NULL;
        $strEDate=NULL;

        $strChartModel= $request->ChartModel;
        $strDate = $request->Date;

        if($strChartModel=='00001'||$strChartModel=='00005'){

            $strSDate=(string)$strDate.'-01-01';
            $strEDate=(string)$strDate.'-12-31';

        }else if($strChartModel=='00002'||$strChartModel=='00006'){


            $strSeasonEDate=  date('Y-m-t',strtotime($request->Year.'-'.(string)((int)$strDate*3).'-01'));
            $strSeasonSDate=NULL;
            if($strDate > 1){
                $strSeasonSDate=$request->Year.'-0'.(string)((($strDate-1)*3)+1).'-01';
            }else{
                $strSeasonSDate=$request->Year.'-01-01';
            }

            $strSDate=$strSeasonSDate;
            $strEDate=$strSeasonEDate;

        }else if($strChartModel=='00003'||$strChartModel=='00007'){
            $strDateFormat = 'Y'.$strDate.'01';

            $strSDate= (string)$strDate.'-01';
            $strEDate= date('Y-m-t',strtotime((string)$strDate.'-01'));

        }else if($strChartModel=='00004'||$strChartModel=='00008'){
            $strSDate=$strDate;
            $strEDate=date("Y-m-d",strtotime("+1 day",strtotime($request->EDate)));
        }

        if($strSDate ==NULL || $strEDate ==NULL){
            $strSDate=date('Y-m-d');
            $strEDate=date('Y-m-d',strtotime('+1 day'));
        }

        return array($strSDate,$strEDate);
    }

    public function getYAxisTitle($strModel='00001'){
        if($strModel==NULL||$strModel=='00001' || $strModel=='00002'|| $strModel=='00003'|| $strModel=='00004'){
            return trans('default.number');
        }else{
            return trans('default.money');
        }
    }

}