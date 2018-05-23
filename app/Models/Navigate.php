<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigate extends Model
{

    protected $table ='navigate';

    protected $fillable = ['name', 'fonts', 'route', 'parent_id', 'is_hidden', 'sort', 'status'];

    /**
     * 只获取显示的数据
     * @param $query
     * @return mixed
     */
    public function scopePublic($query)
    {
        return $query->where('is_hidden', 0);
    }
}
