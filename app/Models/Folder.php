<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;
use Vinelab\NeoEloquent\Eloquent\SoftDeletes;

class Folder extends NeoEloquent
{
    use SoftDeletes;

    /**
     * Label name
     *
     * @var string
     */
    protected $label = 'Folder';

    /**
     * Date array
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Node properties
     *
     * @var array
     */
    protected $fillable = ['uuid', 'name', 'description'];

    /**
     * Team that the employee belongs to
     *
     * @return HasOne
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item', 'HAS_CHILD_CONTENT');
    }

    public function access()
    {
        return $this->hasOne('App\Models\AccessLevel', 'HAS_ACCESS_LEVEL');
    }
}
