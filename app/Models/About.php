<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table ='about';
    protected $primaryKey = 'id';
    protected $fillable =['id','zh_company_name','en_company_name'
                        ,'address','fex','telephone'
                        ,'email','zh_introduction','en_introduction'
                        ,'uniform_number','status'];

}