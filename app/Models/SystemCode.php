<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
/**/
class SystemCode extends Model
{
    protected $table ='systemcode';
    protected $primaryKey = 'id';
    protected $fillable =['code_type','code_id','zh_code_val'
                            ,'en_code_val','para_1','para_2','para_3','start_date','end_date'];
}
