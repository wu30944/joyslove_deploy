<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreInfo extends Model
{

    protected $table ='store_info';

    protected $fillable = ['store_name', 'local', 'address', 'open_time', 'close_time', 'telephone', 'is_hidden','status'];


}
