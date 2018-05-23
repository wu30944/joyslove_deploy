<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class AdminActivation extends Model
{
    protected $table = 'admin_activation';
    protected $fillable = ['token', 'active', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admins()
    {
        return $this->belongsTo('App\Models\Admin','name');
    }


}
