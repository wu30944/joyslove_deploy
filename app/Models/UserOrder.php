<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:07
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $table ='user_order';
    protected $primaryKey = 'id';
    protected $fillable =['order_number','flavor_id','order_name','order_num','money','status'];

}