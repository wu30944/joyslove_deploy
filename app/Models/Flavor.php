<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    protected $table ='flavor';
    protected $primaryKey = 'id';
    protected $fillable =['flavor_name','money','material','status','para_1','para_2'];


}