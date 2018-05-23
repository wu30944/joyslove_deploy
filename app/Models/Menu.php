<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table ='menu';
    protected $primaryKey = 'id';
    protected $fillable =['menu_name','prod_name','prod_intro',
                        'photo','price','status'];


}