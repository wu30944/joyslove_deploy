<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
/**/
class album extends Model
{
    protected $table ='albums';
    protected $primaryKey = 'id';
    protected $fillable =['album_name','position','status'];
}
